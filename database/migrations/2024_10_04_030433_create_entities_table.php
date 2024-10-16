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
        Schema::create('entities', function (Blueprint $table) {
            $table->id(); // ID unik untuk setiap entitas
            $table->string('name'); // Nama entitas (misalnya: "Guru", "Ruang", dll.)
            $table->unsignedBigInteger('entity_type_id'); // Relasi ke tipe entitas
            $table->unsignedBigInteger('user_id'); // Relasi ke pengguna (pemilik entitas)
            $table->timestamps(); // Timestamps created_at dan updated_at

            // Foreign keys
            $table->foreign('entity_type_id')->references('id')->on('entity_types');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entities');
    }
};