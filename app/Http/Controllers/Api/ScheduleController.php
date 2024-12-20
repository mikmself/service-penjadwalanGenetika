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
        try {
            $data = $request->validated();
            $result = $this->geneticAlgorithmService->generateSchedule(
                $data['schedule_id'],
                $data['population_size'],
                $data['crossover_rate'],
                $data['mutation_rate'],
                $data['generations']
            );
            return response()->json([
                'status' => 1,
                'httpCode' => 200,
                'message' => 'Schedule generated successfully',
                'data' => $result
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 0,
                'httpCode' => 500,
                'message' => 'Error generating schedule',
                'errors' => $e->getMessage()
            ], 500);
        }
    }
}
