<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('entity_relationships', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_entity_id');
            $table->unsignedBigInteger('child_entity_id');
            $table->string('relationship_type');
            $table->timestamps();
            $table->foreign('parent_entity_id')->references('id')->on('entities')->onDelete('cascade');
            $table->foreign('child_entity_id')->references('id')->on('entities')->onDelete('cascade');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('entity_relationships');
    }
};
