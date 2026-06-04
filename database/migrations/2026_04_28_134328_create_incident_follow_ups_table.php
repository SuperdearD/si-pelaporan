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
        Schema::create('incident_follow_ups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('incident_id')->constrained('incidents')->onDelete('cascade');
            $table->text('corrective_action');
            $table->string('target_pengendalian');
            $table->text('bentuk_pengendalian');
            $table->string('penanggung_jawab');
            $table->string('status');
            $table->integer('progress');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incident_follow_ups');
    }
};
