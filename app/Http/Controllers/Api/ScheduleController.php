<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreScheduleRequest;
use App\Http\Requests\UpdateScheduleRequest;
use App\Models\Schedule;
use App\Services\ScheduleService;
use Illuminate\Http\JsonResponse;

class ScheduleController extends Controller
{
    protected $scheduleService;

    public function __construct(ScheduleService $scheduleService)
    {
        $this->scheduleService = $scheduleService;
    }

    public function index(): JsonResponse
    {
        $schedules = $this->scheduleService->getAllSchedules();
        return response()->json($schedules);
    }

    public function show($id): JsonResponse
    {
        $schedule = $this->scheduleService->getScheduleById($id);
        return response()->json($schedule);
    }

    public function store(StoreScheduleRequest $request): JsonResponse
    {
        $schedule = $this->scheduleService->createSchedule($request->validated());
        return response()->json($schedule, 201);
    }

    public function update(UpdateScheduleRequest $request, Schedule $schedule): JsonResponse
    {
        $updatedSchedule = $this->scheduleService->updateSchedule($schedule, $request->validated());
        return response()->json($updatedSchedule);
    }

    public function destroy(Schedule $schedule): JsonResponse
    {
        $this->scheduleService->deleteSchedule($schedule);
        return response()->json(null, 204);
    }
}
