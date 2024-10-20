<?php

namespace App\Http\Controllers\Api\Crud;

use App\Http\Controllers\Controller;
use App\Http\Requests\ScheduleRequest\StoreScheduleRequest;
use App\Http\Requests\ScheduleRequest\UpdateScheduleRequest;
use App\Models\Schedule;
use App\Services\Api\Crud\ScheduleService;
use Illuminate\Http\JsonResponse;
use Exception;

class ScheduleController extends Controller
{
    protected $scheduleService;

    public function __construct(ScheduleService $scheduleService)
    {
        $this->scheduleService = $scheduleService;
    }

    public function index(): JsonResponse
    {
        try {
            $schedules = $this->scheduleService->getAllSchedules();
            return $this->sendResponse($schedules, 'Schedules retrieved successfully.');
        } catch (Exception $e) {
            return $this->sendError('Failed to retrieve schedules.', [$e->getMessage()]);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $schedule = $this->scheduleService->getScheduleById($id);
            return $this->sendResponse($schedule, 'Schedule retrieved successfully.');
        } catch (Exception $e) {
            return $this->sendError('Failed to retrieve schedule.', [$e->getMessage()]);
        }
    }

    public function store(StoreScheduleRequest $request): JsonResponse
    {
        try {
            $schedule = $this->scheduleService->createSchedule($request->validated());
            return $this->sendResponse($schedule, 'Schedule created successfully.', 201);
        } catch (Exception $e) {
            return $this->sendError('Failed to create schedule.', [$e->getMessage()]);
        }
    }

    public function update(UpdateScheduleRequest $request, Schedule $schedule): JsonResponse
    {
        try {
            $updatedSchedule = $this->scheduleService->updateSchedule($schedule, $request->validated());
            return $this->sendResponse($updatedSchedule, 'Schedule updated successfully.');
        } catch (Exception $e) {
            return $this->sendError('Failed to update schedule.', [$e->getMessage()]);
        }
    }

    public function destroy(Schedule $schedule): JsonResponse
    {
        try {
            $this->scheduleService->deleteSchedule($schedule);
            return $this->sendResponse(null, 'Schedule deleted successfully.', 200);
        } catch (Exception $e) {
            return $this->sendError('Failed to delete schedule.', [$e->getMessage()]);
        }
    }
}
