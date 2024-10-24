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
            'crossover_rate' => 'required|numeric|between:0,1',
            'mutation_rate' => 'required|numeric|between:0,1',
            'generations' => 'required|integer|min:1',
        ];
    }

    public function messages()
    {
        return [
            'schedule_id.required' => 'Schedule ID is required.',
            'schedule_id.exists' => 'Schedule ID does not exist.',
            'population_size.required' => 'Population size is required.',
            'population_size.integer' => 'Population size must be an integer.',
            'crossover_rate.required' => 'Crossover rate is required.',
            'mutation_rate.required' => 'Mutation rate is required.',
            'generations.required' => 'Generations are required.',
        ];
    }
}
