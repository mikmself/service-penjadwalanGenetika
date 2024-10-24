<?php

namespace App\Services\Api;

use App\Models\Schedule;
use App\Models\Attribute;
use App\Models\Entity;
use App\Models\AttributeValue;
use Illuminate\Support\Facades\Log;

class GeneticAlgorithmService
{
    // Fungsi utama untuk menjalankan algoritma genetika
    public function generateSchedule($scheduleId, $populationSize, $crossoverRate, $mutationRate, $generations)
    {
        $entities = Entity::where('schedule_id', $scheduleId)->get();
        $population = $this->generateInitialPopulation($entities, $populationSize);
        for ($i = 0; $i < $generations; $i++) {
            $selectedParents = $this->selectParents($population);
            $offspring = $this->crossover($selectedParents, $crossoverRate);
            $offspring = $this->mutate($offspring, $mutationRate);
            $population = $this->evaluateAndReplace($population, $offspring);
        }
        return $this->formatScheduleResult($population);
    }
    private function generateInitialPopulation($entities, $populationSize)
    {
        $population = [];
        for ($i = 0; $i < $populationSize; $i++) {
            $schedule = [];
            foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'] as $day) {
                // Loop untuk setiap hari
                foreach ($entities as $entity) {
                    if (is_object($entity)) {
                        $schedule[$day][] = $this->generateRandomScheduleForDay($entity);
                    }
                }
            }
            $population[] = $schedule;
        }
        return $population;
    }
    private function generateRandomScheduleForDay($entity)
    {
        $daySchedule = [];
        if (!$entity || !isset($entity->id)) {
            Log::warning('Invalid entity detected', ['entity' => $entity]);
            return [];
        }
        $attributes = Attribute::where('entity_id', $entity->id)->get();

        if ($attributes->isEmpty()) {
            Log::warning('No attributes found for entity_id: ' . $entity->id);
            return [];
        }
        Log::info('Attributes found for entity_id: ' . $entity->id, ['attributes' => $attributes]);
        $daySchedule = $attributes->map(function ($attribute) {
            $attributeValue = AttributeValue::where('attribute_id', $attribute->id)->first();
            if (!$attributeValue) {
                return ['attribute_name' => $attribute->name, 'value' => 'No value'];
            }
            $value = $this->getAttributeValue($attributeValue);
            return [
                'attribute_name' => $attribute->name,
                'value' => $value,
            ];
        })->toArray();
        return $daySchedule;
    }
    private function getAttributeValue($attributeValue)
    {
        if ($attributeValue->value_string) {
            return $attributeValue->value_string;
        } elseif ($attributeValue->value_int) {
            return $attributeValue->value_int;
        } elseif ($attributeValue->value_datetime) {
            return $attributeValue->value_datetime;
        }

        return null;
    }
    private function generateRandomValueForAttribute($attribute)
    {
        if ($attribute->data_type === 'string') {
            return 'Random String'; // Misalnya nama dosen, bisa dikembangkan
        } elseif ($attribute->data_type === 'integer') {
            return rand(1, 100); // Misalnya untuk kapasitas kelas
        } elseif ($attribute->data_type === 'datetime') {
            return now()->toDateTimeString();
        }
    }
    private function selectParents($population)
    {
        return $population;
    }
    private function crossover($parents, $crossoverRate)
    {
        foreach ($parents as $index => $parent) {
            if (rand(0, 100) / 100 <= $crossoverRate) {
                $swapIndex = rand(1, count($parent) - 1);
                $temp = $parent;
                $parents[$index] = array_merge(array_slice($temp, 0, $swapIndex), array_slice($parents[$index], $swapIndex));
            }
        }
        return $parents;
    }
    private function mutate($offspring, $mutationRate)
    {
        foreach ($offspring as $index => $child) {
            if (rand(0, 100) / 100 <= $mutationRate) {
                $randomDay = array_rand($child);
                $child[$randomDay] = $this->generateRandomScheduleForDay($child);
            }
        }
        return $offspring;
    }
    private function evaluateAndReplace($population, $offspring)
    {
        return $offspring;
    }
    private function formatScheduleResult($population)
    {
        if (empty($population)) {
            return ['message' => 'No valid schedule generated'];
        }

        return [
            'schedule' => $population[0]
        ];
    }
}
