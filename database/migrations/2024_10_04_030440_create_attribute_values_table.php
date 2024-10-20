<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attribute_values', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('attribute_id');
            $table->text('value_string')->nullable();
            $table->integer('value_int')->nullable();
            $table->timestamp('value_datetime')->nullable();
            $table->timestamps();
            $table->foreign('attribute_id')->references('id')->on('attributes')->onDelete('cascade');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('attribute_values');
    }
};
