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
            if (empty($result) || !isset($result['schedule'])) {
                return $this->sendError('Failed to generate a valid schedule', [], 400);
            }
            return $this->sendResponse($result, 'Schedule generated successfully');
        } catch (\Exception $e) {
            return $this->sendError('Error generating schedule', [$e->getMessage()], 500);
        }
    }
}
