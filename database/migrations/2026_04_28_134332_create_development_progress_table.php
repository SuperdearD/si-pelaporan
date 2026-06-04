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
        Schema::create('development_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('incident_development_id')->constrained('incident_developments')->onDelete('cascade');
            $table->string('message_id')->nullable();
            $table->string('pic')->nullable();
            $table->date('tanggal')->nullable();
            $table->text('hasil_progress')->nullable();
            $table->integer('persentase')->default(0);
            $table->string('file')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('development_progress');
    }
};
