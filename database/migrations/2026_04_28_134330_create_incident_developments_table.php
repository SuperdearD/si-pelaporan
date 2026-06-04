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
        Schema::create('incident_developments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('incident_id')->constrained('incidents')->onDelete('cascade');
            $table->text('bentuk_pengembangan')->nullable();
            $table->text('hasil_pengembangan')->nullable();
            $table->integer('persentase')->default(0);
            $table->string('status')->nullable();
            $table->date('tanggal')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users'); // PIC Pengembangan
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
