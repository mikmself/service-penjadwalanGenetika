<?php

namespace App\Services\Api;

use App\Models\Schedule;
use App\Models\Attribute;
use App\Models\Entity;
use App\Models\AttributeValue;
use Illuminate\Support\Facades\Log;

class GeneticAlgorithmService
{
    // Fungsi utama untuk menjalankan algoritma genetika
    public function generateSchedule($scheduleId, $populationSize, $crossoverRate, $mutationRate, $generations)
    {
        // Ambil schedule dan entities terkait
        $schedule = Schedule::findOrFail($scheduleId);
        $entities = Entity::where('schedule_id', $scheduleId)->get();

        // Step 1: Generate Initial Population
        $population = $this->generateInitialPopulation($entities, $populationSize);

        for ($i = 0; $i < $generations; $i++) {
            // Step 2: Selection (Parent Selection)
            $selectedParents = $this->selectParents($population);

            // Step 3: Crossover
            $offspring = $this->crossover($selectedParents, $crossoverRate);

            // Step 4: Mutation
            $offspring = $this->mutate($offspring, $mutationRate);

            // Step 5: Evaluate and Replace Population
            $population = $this->evaluateAndReplace($population, $offspring);
        }

        // Step 6: Return Final Result
        return $this->formatScheduleResult($population);
    }

    // Generate populasi awal secara acak berdasarkan entitas yang ada
    private function generateInitialPopulation($entities, $populationSize)
    {
        $population = [];
        for ($i = 0; $i < $populationSize; $i++) {
            $schedule = [];
            foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'] as $day) {
                // Loop untuk setiap hari
                foreach ($entities as $entity) {
                    if (is_object($entity)) {
                        $schedule[$day][] = $this->generateRandomScheduleForDay($entity);
                    }
                }
            }
            $population[] = $schedule;
        }
        return $population;
    }

    // Generate jadwal acak untuk setiap hari
    private function generateRandomScheduleForDay($entity)
    {
        $daySchedule = [];

        if (!$entity || !isset($entity->id)) {
            \Log::warning('Invalid entity detected', ['entity' => $entity]);
            return []; // Lewati jika entity tidak valid
        }

        // Ambil attributes berdasarkan entity_id
        $attributes = Attribute::where('entity_id', $entity->id)->get();

        if ($attributes->isEmpty()) {
            \Log::warning('No attributes found for entity_id: ' . $entity->id);
            return []; // Lewati jika tidak ada attribute
        }

        \Log::info('Attributes found for entity_id: ' . $entity->id, ['attributes' => $attributes]);

        // Map attributes ke nilai attribute_values
        $daySchedule = $attributes->map(function ($attribute) {
            // Ambil nilai attribute_value berdasarkan attribute_id
            $attributeValue = AttributeValue::where('attribute_id', $attribute->id)->first();

            if (!$attributeValue) {
                return ['attribute_name' => $attribute->name, 'value' => 'No value'];
            }

            // Tentukan nilai berdasarkan data_type
            $value = $this->getAttributeValue($attributeValue);

            return [
                'attribute_name' => $attribute->name,
                'value' => $value,
            ];
        })->toArray();

        return $daySchedule;
    }

    // Fungsi tambahan untuk mengambil nilai dari attribute_values
    private function getAttributeValue($attributeValue)
    {
        if ($attributeValue->value_string) {
            return $attributeValue->value_string;
        } elseif ($attributeValue->value_int) {
            return $attributeValue->value_int;
        } elseif ($attributeValue->value_datetime) {
            return $attributeValue->value_datetime;
        }

        return null;
    }


    // Generate nilai acak untuk setiap atribut berdasarkan tipe data
    private function generateRandomValueForAttribute($attribute)
    {
        if ($attribute->data_type === 'string') {
            return 'Random String'; // Misalnya nama dosen, bisa dikembangkan
        } elseif ($attribute->data_type === 'integer') {
            return rand(1, 100); // Misalnya untuk kapasitas kelas
        } elseif ($attribute->data_type === 'datetime') {
            return now()->toDateTimeString();
        }
    }

    // Seleksi individu terbaik (misalnya dengan roulette wheel atau tournament selection)
    private function selectParents($population)
    {
        // Sederhananya, kita bisa langsung return populasi tanpa evaluasi
        return $population;
    }

    // Crossover antar dua parent untuk menghasilkan offspring
    private function crossover($parents, $crossoverRate)
    {
        // Untuk tiap pasangan parent, lakukan crossover berdasarkan crossoverRate
        foreach ($parents as $index => $parent) {
            if (rand(0, 100) / 100 <= $crossoverRate) {
                // Proses crossover sederhana: swap sebagian data antara dua parent
                $swapIndex = rand(1, count($parent) - 1);
                $temp = $parent;
                $parents[$index] = array_merge(array_slice($temp, 0, $swapIndex), array_slice($parents[$index], $swapIndex));
            }
        }
        return $parents;
    }

    // Mutasi pada offspring dengan mutasi acak
    private function mutate($offspring, $mutationRate)
    {
        foreach ($offspring as $index => $child) {
            if (rand(0, 100) / 100 <= $mutationRate) {
                // Mutasi sederhana, mengganti beberapa nilai acak
                $randomDay = array_rand($child);
                $child[$randomDay] = $this->generateRandomScheduleForDay($child);
            }
        }
        return $offspring;
    }

    // Evaluasi dan penggantian populasi
    private function evaluateAndReplace($population, $offspring)
    {
        // Sebagai contoh, kita bisa menggantikan populasi lama dengan offspring
        return $offspring;
    }

    // Format hasil penjadwalan ke dalam bentuk JSON
    private function formatScheduleResult($population)
    {
        // Ambil individu terbaik dari populasi terakhir
        if (empty($population)) {
            return ['message' => 'No valid schedule generated'];
        }

        return [
            'schedule' => $population[0] // Kembalikan individu terbaik
        ];
    }
}
