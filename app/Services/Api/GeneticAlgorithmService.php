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
        Log::info("Processing entity:", ['entity' => $entity->name]);

        $attributeValues = [];
        if (isset($entity->attributeValues)) {
            foreach ($entity->attributeValues as $value) {
                Log::info("Processing attribute:", ['attribute' => $value->attribute->name, 'value' => $value]);

                switch ($value->attribute->data_type) {
                    case 'string':
                        $attributeValues[$value->attribute->name] = $value->value_string ?? 'N/A';
                        break;
                    case 'integer':
                        $attributeValues[$value->attribute->name] = $value->value_int ?? 'N/A';
                        break;
                    case 'datetime':
                        $attributeValues[$value->attribute->name] = $value->value_datetime ?? 'N/A';
                        break;
                    default:
                        Log::warning("Unhandled attribute data type for entity: {$entity->name}, attribute: {$value->attribute->name}");
                }
            }
        } else {
            Log::warning("Entity has no attributeValues:", ['entity' => $entity->name]);
        }

        return [
            'entity' => $entity->name,
            'attributes' => $attributeValues,
        ];
    }

    private function formatBestSchedule($bestSchedule)
    {
        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        $formattedSchedule = [];

        foreach ($days as $day) {
            $daySchedule = array_filter($bestSchedule, function ($schedule) use ($day) {
                return isset($schedule['attributes']['Hari']) && $schedule['attributes']['Hari'] === $day;
            });

            Log::info("Jadwal untuk hari {$day}", ['schedule' => $daySchedule]);

            if (count($daySchedule) > 0) {
                $formattedSchedule[$day] = array_map(function ($item) {
                    return [
                        'Jam' => $item['attributes']['Waktu Mulai'] . ' - ' . $item['attributes']['Waktu Selesai'],
                        'Mata Kuliah' => $item['attributes']['Nama Mata Kuliah'] ?? 'N/A',
                        'SKS' => $item['attributes']['SKS'] ?? 'N/A',
                        'Dosen' => $item['attributes']['Nama Lengkap'] ?? 'N/A',
                        'Ruang' => $item['attributes']['Nama Ruang'] ?? 'N/A',
                    ];
                }, $daySchedule);
            } else {
                $formattedSchedule[$day] = []; // Hari kosong
            }
        }

        return $formattedSchedule;
    }

    // Fitness function to evaluate the quality of the schedule
    private function fitness($schedule)
    {
        $fitnessScore = 0;
        $timeConflicts = [];

        foreach ($schedule as $item) {
            // Pengecekan apakah 'Waktu Mulai' dan 'Waktu Selesai' ada sebelum digunakan
            $waktuMulai = array_key_exists('Waktu Mulai', $item['attributes']) ? $item['attributes']['Waktu Mulai'] : 'N/A';
            $waktuSelesai = array_key_exists('Waktu Selesai', $item['attributes']) ? $item['attributes']['Waktu Selesai'] : 'N/A';

            Log::info("Fitness - Jam:", ['Waktu Mulai' => $waktuMulai, 'Waktu Selesai' => $waktuSelesai]);

            // Jika waktu valid, baru tambahkan ke pengecekan
            if ($waktuMulai !== 'N/A' && $waktuSelesai !== 'N/A') {
                $timeSlot = $waktuMulai . '-' . $waktuSelesai;
                if (!isset($timeConflicts[$timeSlot])) {
                    $timeConflicts[$timeSlot] = [];
                }
                $timeConflicts[$timeSlot][] = $item;
            } else {
                Log::warning("Missing 'Waktu Mulai' or 'Waktu Selesai' for schedule item:", ['item' => $item]);
            }
        }

        // Cek tabrakan waktu
        foreach ($timeConflicts as $slot => $items) {
            if (count($items) > 1) {
                $fitnessScore -= 10 * count($items); // Penalti untuk tabrakan jadwal
            }
        }

        return $fitnessScore;
    }

    // Run the genetic algorithm
    public function runAlgorithm($entities)
    {
        $this->initializePopulation($entities);

        for ($generation = 0; $generation < $this->maxGenerations; $generation++) {
            $evaluatedPopulation = $this->evaluatePopulation();
            $selectedParents = $this->selection($evaluatedPopulation);
            $offspring = $this->crossover($selectedParents);
            $mutatedOffspring = $this->mutation($offspring);
            $this->population = $mutatedOffspring;

            Log::info("Generation: $generation, Best Fitness: " . $this->getBestFitness($evaluatedPopulation));
        }

        return $this->formatBestSchedule($this->getBestSolution());
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
                // Mutate a random part of the child
                // Mutasi atribut pada index
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
