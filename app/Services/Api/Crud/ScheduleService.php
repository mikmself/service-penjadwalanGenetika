<?php

namespace App\Services\Api\Crud;

use App\Models\Schedule;
use Illuminate\Support\Facades\DB;
use Exception;

class ScheduleService
{
    public function getAllSchedules()
    {
        return Schedule::with('user', 'entities')->get();
    }

    public function getScheduleById($id)
    {
        return Schedule::with('user', 'entities')->findOrFail($id);
    }

    public function createSchedule(array $data)
    {
        try {
            return DB::transaction(function () use ($data) {
                return Schedule::create($data);
            });
        } catch (Exception $e) {
            throw new Exception('Error creating schedule: ' . $e->getMessage());
        }
    }

    public function updateSchedule(Schedule $schedule, array $data)
    {
        try {
            return DB::transaction(function () use ($schedule, $data) {
                $schedule->update($data);
                return $schedule;
            });
        } catch (Exception $e) {
            throw new Exception('Error updating schedule: ' . $e->getMessage());
        }
    }

    public function deleteSchedule(Schedule $schedule)
    {
        try {
            return DB::transaction(function () use ($schedule) {
                return $schedule->delete();
            });
        } catch (Exception $e) {
            throw new Exception('Error deleting schedule: ' . $e->getMessage());
        }
    }
}
