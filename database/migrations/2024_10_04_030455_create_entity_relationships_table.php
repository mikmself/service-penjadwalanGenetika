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
        Schema::create('entity_relationships', function (Blueprint $table) {
            $table->id(); // ID unik untuk relasi entitas
            $table->unsignedBigInteger('parent_entity_id'); // Relasi ke entitas parent
            $table->unsignedBigInteger('child_entity_id'); // Relasi ke entitas child
            $table->string('relationship_type'); // Tipe hubungan (misalnya: "assign", "belong", "own")
            $table->timestamps(); // Timestamps created_at dan updated_at

            // Foreign keys
            $table->foreign('parent_entity_id')->references('id')->on('entities')->onDelete('cascade');
            $table->foreign('child_entity_id')->references('id')->on('entities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entity_relationships');
    }
};
