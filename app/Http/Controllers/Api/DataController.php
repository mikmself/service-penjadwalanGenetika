<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Entity;
use App\Models\Schedule;
use Illuminate\Http\JsonResponse;

class DataController extends Controller
{
    public function getSchedulesByUser($userId): JsonResponse
    {
        try {
            $schedules = Schedule::where('user_id', $userId)->get();

            if ($schedules->isEmpty()) {
                return response()->json(['message' => 'No schedules found for this user'], 404);
            }

            return response()->json(['data' => $schedules], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error fetching schedules', 'error' => $e->getMessage()], 500);
        }
    }
    public function getEntitiesBySchedule($scheduleId): JsonResponse
    {
        try {
            $entities = Entity::where('schedule_id', $scheduleId)->get();

            if ($entities->isEmpty()) {
                return response()->json(['message' => 'No entities found for this schedule'], 404);
            }

            return response()->json(['data' => $entities], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error fetching entities', 'error' => $e->getMessage()], 500);
        }
    }
    // Get attributes & attribute values berdasarkan id entity
    public function getAttributesByEntity($entityId): JsonResponse
    {
        try {
            // Ambil semua attributes berdasarkan entity_id
            $attributes = Attribute::where('entity_id', $entityId)->get();

            if ($attributes->isEmpty()) {
                return response()->json(['message' => 'No attributes found for this entity'], 404);
            }

            // Ambil semua values untuk setiap attribute dan strukturkan sebagai tabel
            $rows = [];
            $maxValues = 0;

            // Hitung jumlah maksimal rows berdasarkan attribute value terbanyak
            foreach ($attributes as $attribute) {
                $attributeValuesCount = AttributeValue::where('attribute_id', $attribute->id)->count();
                if ($attributeValuesCount > $maxValues) {
                    $maxValues = $attributeValuesCount;
                }
            }

            // Buat rows sesuai jumlah maksimal values
            for ($i = 0; $i < $maxValues; $i++) {
                $row = [];
                foreach ($attributes as $attribute) {
                    $attributeValues = AttributeValue::where('attribute_id', $attribute->id)->get();

                    // Cek apakah value ada untuk row ini, jika tidak tambahkan null
                    $value = $attributeValues->get($i);
                    $row[$attribute->name] = $value ? $this->getAttributeValue($value) : null;
                }
                $rows[] = $row;
            }

            return response()->json(['data' => $rows], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error fetching attributes and values', 'error' => $e->getMessage()], 500);
        }
    }

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
}
