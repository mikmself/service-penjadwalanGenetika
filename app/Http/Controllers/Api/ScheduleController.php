<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ScheduleRequest\ScheduleRequest;
use App\Models\Entity;
use App\Services\Api\GeneticAlgorithmService;

class ScheduleController extends Controller
{
    public function generateSchedule(ScheduleRequest $request)
    {
        $entities = Entity::where('schedule_id', $request->schedule_id)
            ->with('attributes.attributeValues.attribute')
            ->get();
        $geneticAlgorithmService = new GeneticAlgorithmService(
            $request->population_size,
            $request->max_generations,
            $request->mutation_rate,
            $request->crossover_rate
        );

        $bestSchedule = $geneticAlgorithmService->runAlgorithm($entities);

        return response()->json([
            'status' => 'success',
            'data' => $bestSchedule,
        ]);
    }
}
