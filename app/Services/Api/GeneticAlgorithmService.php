<?php

namespace App\Services\Api;

use Illuminate\Support\Facades\Log;

class GeneticAlgorithmService
{
    protected $population;
    protected $populationSize;
    protected $maxGenerations;
    protected $mutationRate;
    protected $crossoverRate;

    public function __construct($populationSize, $maxGenerations, $mutationRate, $crossoverRate)
    {
        $this->populationSize = $populationSize;
        $this->maxGenerations = $maxGenerations;
        $this->mutationRate = $mutationRate;
        $this->crossoverRate = $crossoverRate;
    }

    // Generate initial population
    public function initializePopulation($entities)
    {
        $this->population = [];
        for ($i = 0; $i < $this->populationSize; $i++) {
            $this->population[] = $this->createRandomSchedule($entities);
        }
    }

    // Create random schedule based on entities and their attributes
    public function createRandomSchedule($entities)
    {
        $schedule = [];
        foreach ($entities as $entity) {
            $schedule[] = $this->randomizeAttributes($entity);
        }
        return $schedule;
    }

    // Randomize attribute values from attribute_values for each entity
    private function randomizeAttributes($entity)
    {
        $attributeValues = [];
        foreach ($entity->attributeValues as $value) {
            switch ($value->attribute->data_type) {
                case 'string':
                    $attributeValues[$value->attribute->name] = $value->value_string;
                    break;
                case 'integer':
                    $attributeValues[$value->attribute->name] = $value->value_int;
                    break;
                case 'datetime':
                    $attributeValues[$value->attribute->name] = $value->value_datetime;
                    break;
            }
        }
        return [
            'entity' => $entity->name,
            'attributes' => $attributeValues,
        ];
    }

    // Fitness function to evaluate the quality of the schedule
    public function fitness($schedule)
    {
        // Add your fitness logic here (e.g., check for conflicts, time constraints, etc.)
        $fitnessScore = 0;
        // Implement logic for conflicts, resource availability, etc.
        return $fitnessScore;
    }

    // Run the genetic algorithm
    public function runAlgorithm($entities)
    {
        $this->initializePopulation($entities);

        for ($generation = 0; $generation < $this->maxGenerations; $generation++) {
            // Evaluate population
            $evaluatedPopulation = $this->evaluatePopulation();

            // Select parents for crossover
            $selectedParents = $this->selection($evaluatedPopulation);

            // Apply crossover
            $offspring = $this->crossover($selectedParents);

            // Apply mutation
            $mutatedOffspring = $this->mutation($offspring);

            // Replace old population with new offspring
            $this->population = $mutatedOffspring;

            // Optionally, log progress or store best result
            Log::info("Generation: $generation, Best Fitness: " . $this->getBestFitness($evaluatedPopulation));
        }

        // Return the best schedule after all generations
        return $this->getBestSolution();
    }

    // Evaluate the fitness of each schedule in the population
    private function evaluatePopulation()
    {
        return array_map(function ($schedule) {
            return ['schedule' => $schedule, 'fitness' => $this->fitness($schedule)];
        }, $this->population);
    }

    // Select the best solutions for crossover
    private function selection($evaluatedPopulation)
    {
        // Sort based on fitness (higher is better)
        usort($evaluatedPopulation, function ($a, $b) {
            return $b['fitness'] <=> $a['fitness'];
        });
        return array_slice($evaluatedPopulation, 0, ceil($this->populationSize * $this->crossoverRate));
    }

    // Perform crossover between selected parents
    private function crossover($selectedParents)
    {
        $offspring = [];
        for ($i = 0; $i < count($selectedParents) - 1; $i++) {
            $parent1 = $selectedParents[$i]['schedule'];
            $parent2 = $selectedParents[$i + 1]['schedule'];
            $offspring[] = $this->cross($parent1, $parent2);
        }
        return $offspring;
    }

    // Cross two parents to create an offspring
    private function cross($parent1, $parent2)
    {
        $crossoverPoint = rand(0, count($parent1) - 1);
        return array_merge(array_slice($parent1, 0, $crossoverPoint), array_slice($parent2, $crossoverPoint));
    }

    // Apply mutation to offspring
    private function mutation($offspring)
    {
        return array_map(function ($child) {
            if (rand() / getrandmax() < $this->mutationRate) {
                // Pastikan 'attributes' ada sebelum diakses
                if (isset($child['attributes']) && count($child['attributes']) > 0) {
                    // Mutate a random part of the child
                    $index = rand(0, count($child['attributes']) - 1);
                    // Mutasi atribut pada index
                    // Misalnya, ubah nilainya atau acak ulang atribut
                }
            }
            return $child;
        }, $offspring);
    }

    // Get the best solution based on fitness
    private function getBestSolution()
    {
        $evaluatedPopulation = $this->evaluatePopulation();
        usort($evaluatedPopulation, function ($a, $b) {
            return $b['fitness'] <=> $a['fitness'];
        });
        return $evaluatedPopulation[0]['schedule'];
    }

    // Get the best fitness score
    private function getBestFitness($evaluatedPopulation)
    {
        return max(array_column($evaluatedPopulation, 'fitness'));
    }
}
