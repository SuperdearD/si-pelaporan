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
        Schema::create('follow_up_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('incident_follow_up_id')->constrained('incident_follow_ups')->onDelete('cascade');
            $table->string('message_id')->nullable();
            $table->string('pic')->nullable();
            $table->text('keterangan')->nullable();
            $table->integer('persentase_progress')->default(0);
            $table->string('file')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('follow_up_progress');
    }
};
