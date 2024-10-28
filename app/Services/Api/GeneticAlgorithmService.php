<?php

namespace App\Services\Api;

use App\Models\Attribute;
use App\Models\Entity;
use App\Models\AttributeValue;

class GeneticAlgorithmService
{
    public function generateSchedule($scheduleId, $populationSize, $crossoverRate, $mutationRate, $generations)
    {
        $entities = Entity::where('schedule_id', $scheduleId)->get();
        $days = AttributeValue::whereHas('attribute', function ($query) {
            $query->where('name', 'Hari');
        })->pluck('value_string')->unique()->values();
        $population = $this->generateInitialPopulation($entities, $days, $populationSize);
        for ($i = 0; $i < $generations; $i++) {
            $selectedParents = $this->selectParents($population);
            $offspring = $this->crossover($selectedParents, $crossoverRate);
            $offspring = $this->mutate($offspring, $days, $mutationRate);
            $population = $this->evaluateAndReplace($population, $offspring);
        }
        return $this->formatScheduleResult($population[0], $days);
    }
    private function generateNonConflictingSchedule($entities)
    {
        $daySchedule = [];
        $usedSlots = [];
        $mataKuliahAllocated = 0;
        foreach ($entities as $entity) {
            if (!is_object($entity)) {
                continue;
            }
            if ($mataKuliahAllocated >= 10) break;
            $attributes = Attribute::where('entity_id', $entity->id)->get();
            $attributesData = $attributes->mapWithKeys(function ($attribute) use ($usedSlots) {
                $attributeValue = AttributeValue::where('attribute_id', $attribute->id)->inRandomOrder()->first();
                if (!$attributeValue || !is_object($attributeValue) || isset($usedSlots[$attributeValue->id])) {
                    return [];
                }
                return [$attribute->name => $this->getAttributeValue($attributeValue)];
            })->toArray();
            if (!empty($attributesData)) {
                $daySchedule[] = $attributesData;
                $this->markSlotAsUsed($usedSlots, $attributesData);
                $mataKuliahAllocated++;
            }
        }
        return $daySchedule;
    }
    private function generateInitialPopulation($entities, $days, $populationSize)
    {
        $population = [];
        for ($i = 0; $i < $populationSize; $i++) {
            $schedule = [];
            foreach ($days as $day) {
                $schedule[$day] = rand(0, 1) ? $this->generateNonConflictingSchedule($entities) : [];
            }
            $population[] = $schedule;
        }
        return $population;
    }
    private function getAttributeValue($attributeValue)
    {
        if ($attributeValue instanceof AttributeValue) {
            if ($attributeValue->value_string) {
                return $attributeValue->value_string;
            } elseif ($attributeValue->value_int) {
                return $attributeValue->value_int;
            } elseif ($attributeValue->value_datetime) {
                return $attributeValue->value_datetime;
            }
        }
        return null;
    }
    private function markSlotAsUsed(&$usedSlots, $attributesData)
    {
        foreach ($attributesData as $data) {
            $usedSlots[] = $data;
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
    private function mutate($offspring, $days, $mutationRate)
    {
        foreach ($offspring as $index => $child) {
            if (rand(0, 100) / 100 <= $mutationRate) {
                $randomDay = $days->random();
                $child[$randomDay] = $this->generateNonConflictingSchedule($child);
            }
        }
        return $offspring;
    }
    private function evaluateAndReplace($population, $offspring)
    {
        return $offspring;
    }
    private function formatScheduleResult($schedule, $days)
    {
        $formattedSchedule = [];
        foreach ($days as $day) {
            $formattedSchedule[strtolower($day)] = $schedule[$day] ?? [];
        }
        return [
            'schedule' => $formattedSchedule
        ];
    }
}
