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
        Schema::create('incident_developments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('incident_id')->constrained('incidents')->onDelete('cascade');
            $table->text('bentuk_pengembangan');
            $table->text('hasil_pengembangan');
            $table->integer('persentase');
            $table->string('status');
            $table->date('tanggal');
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incident_developments');
    }
};
