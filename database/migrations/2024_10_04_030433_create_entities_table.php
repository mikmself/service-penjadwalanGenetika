<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('entities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('entity_type_id');
            $table->unsignedBigInteger('schedule_id');
            $table->timestamps();
            $table->foreign('entity_type_id')->references('id')->on('entity_types');
            $table->foreign('schedule_id')->references('id')->on('schedules');

        });
    }
    public function down(): void
    {
        Schema::dropIfExists('entities');
    }
};
