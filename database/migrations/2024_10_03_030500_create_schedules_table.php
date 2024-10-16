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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id(); // ID unik untuk setiap jadwal
            $table->unsignedBigInteger('user_id'); // Relasi ke user yang membuat jadwal
            $table->string('name'); // Nama jadwal (misalnya: "Jadwal Kelas", "Shift Pekerja")
            $table->timestamps(); // Timestamps created_at dan updated_at
            // Foreign key
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
