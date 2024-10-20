<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attributes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('entity_id');
            $table->string('name');
            $table->enum('data_type', ['string', 'integer', 'datetime']);
            $table->boolean('nullable')->default(false);
            $table->string('default_value')->nullable();
            $table->timestamps();
            $table->foreign('entity_id')->references('id')->on('entities')->onDelete('cascade');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('attributes');
    }
};
