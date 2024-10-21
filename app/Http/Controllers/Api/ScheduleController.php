<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ScheduleRequest\ScheduleRequest;
use App\Models\Entity;
use App\Services\Api\GeneticAlgorithmService;
use Illuminate\Support\Facades\Log;

class ScheduleController extends Controller
{
    public function generateSchedule(ScheduleRequest $request)
    {
        $entities = Entity::where('schedule_id', $request->schedule_id)
            ->with('attributes.attributeValues.attribute')
            ->get();

        Log::info("Entities retrieved for schedule", ['schedule_id' => $request->schedule_id, 'entities' => $entities]);

        foreach ($entities as $entity) {
            foreach ($entity->attributeValues as $attributeValue) {
                if (!isset($attributeValue->attribute->name)) {
                    Log::warning("Atribut tidak ditemukan pada entitas {$entity->name}: {$attributeValue->attribute->name}");
                }
            }
        }

        $geneticAlgorithmService = new GeneticAlgorithmService(
            $request->population_size,
            $request->max_generations,
            $request->mutation_rate,
            $request->crossover_rate
        );

        $bestSchedule = $geneticAlgorithmService->runAlgorithm($entities);

        return $this->sendResponse($bestSchedule, 'Schedule generated successfully');
    }
}
