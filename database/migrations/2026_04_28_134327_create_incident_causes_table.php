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
        Schema::create('incident_causes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('incident_id')->constrained('incidents')->onDelete('cascade');
            $table->text('unsafe_action');
            $table->text('unsafe_condition');
            $table->text('person_factor');
            $table->text('job_factor');
            $table->text('env_factor');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incident_causes');
    }
};
