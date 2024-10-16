<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScheduleRequest;
use App\Services\GeneticAlgorithmService;
use App\Models\Entity;

class ScheduleController extends Controller
{
    public function generateSchedule(ScheduleRequest $request)
    {
        // Dapatkan entitas terkait dengan schedule_id
        $entities = Entity::where('schedule_id', $request->schedule_id)->with('attributeValues.attribute')->get();

        // Buat instance GeneticAlgorithmService dengan parameter yang diambil dari request
        $geneticAlgorithmService = new GeneticAlgorithmService(
            $request->population_size,
            $request->max_generations,
            $request->mutation_rate,
            $request->crossover_rate
        );

        // Jalankan algoritma genetika
        $bestSchedule = $geneticAlgorithmService->runAlgorithm($entities);

        // Kembalikan hasil dalam format JSON
        return response()->json([
            'status' => 'success',
            'data' => $bestSchedule,
        ]);
    }
}
