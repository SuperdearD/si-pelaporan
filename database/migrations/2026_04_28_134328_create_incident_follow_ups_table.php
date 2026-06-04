<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('incident_follow_ups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('incident_id')->constrained('incidents')->onDelete('cascade');
            $table->text('corrective_action')->nullable();
            $table->string('target_pengendalian')->nullable();
            $table->text('bentuk_pengendalian')->nullable();
            $table->string('penanggung_jawab')->nullable();
            $table->string('status')->nullable();
            $table->string('status_approval')->nullable()->default('Ditolak');
            $table->integer('progress')->default(0); // Beri default 0
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
