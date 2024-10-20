<?php

namespace App\Http\Requests\ScheduleRequest;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'schedule_id' => 'required|exists:schedules,id',
            'population_size' => 'required|integer|min:10',
            'max_generations' => 'required|integer|min:1',
            'mutation_rate' => 'required|numeric|between:0,1',
            'crossover_rate' => 'required|numeric|between:0,1',
        ];
    }
}
