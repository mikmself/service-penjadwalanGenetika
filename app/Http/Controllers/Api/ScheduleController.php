<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ScheduleRequest\ScheduleRequest;
use App\Services\Api\GeneticAlgorithmService;
use Illuminate\Http\JsonResponse;

class ScheduleController extends Controller
{
    protected $geneticAlgorithmService;

    public function __construct(GeneticAlgorithmService $geneticAlgorithmService)
    {
        $this->geneticAlgorithmService = $geneticAlgorithmService;
    }

    public function generateSchedule(ScheduleRequest $request): JsonResponse
    {
        // Data dari request
        $data = $request->validated();

        // Memanggil service untuk menjalankan algoritma genetika
        $result = $this->geneticAlgorithmService->generateSchedule(
            $data['schedule_id'],
            $data['population_size'],
            $data['crossover_rate'],
            $data['mutation_rate'],
            $data['generations']
        );

        return response()->json($result);
    }
}
