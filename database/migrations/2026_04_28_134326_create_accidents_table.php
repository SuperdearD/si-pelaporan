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
        Schema::create('accidents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('incident_id')->constrained('incidents')->onDelete('cascade');
            $table->string('accident_place');
            $table->string('accident_condition');
            $table->text('accident_description');
            $table->string('safety_incidents');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accidents');
    }
};
