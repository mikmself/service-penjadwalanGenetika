<?php

namespace App\Services;

use App\Models\Schedule;

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
        return Schedule::create($data);
    }

    public function updateSchedule(Schedule $schedule, array $data)
    {
        $schedule->update($data);
        return $schedule;
    }

    public function deleteSchedule(Schedule $schedule)
    {
        return $schedule->delete();
    }
}
