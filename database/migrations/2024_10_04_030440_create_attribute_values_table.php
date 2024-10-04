<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('attribute_values', function (Blueprint $table) {
            $table->id(); // ID unik untuk setiap nilai atribut
            $table->unsignedBigInteger('entity_id'); // Relasi ke entitas
            $table->unsignedBigInteger('attribute_id'); // Relasi ke atribut
            $table->text('value'); // Nilai atribut, bisa string, number, atau lainnya
            $table->timestamps(); // Timestamps created_at dan updated_at

            // Foreign keys
            $table->foreign('entity_id')->references('id')->on('entities')->onDelete('cascade');
            $table->foreign('attribute_id')->references('id')->on('attributes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attribute_values');
    }
};
