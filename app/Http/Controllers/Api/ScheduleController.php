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
        // Dapatkan entitas terkait dengan schedule_id
        $entities = Entity::where('schedule_id', $request->schedule_id)
            ->with('attributes.attributeValues.attribute') // Sesuaikan relasi
            ->get();

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
