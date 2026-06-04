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
        Schema::create('development_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('incident_development_id')->constrained('incident_developments')->onDelete('cascade');
            $table->string('message_id')->nullable();
            $table->text('hasil')->nullable();
            $table->text('kesimpulan')->nullable();
            $table->text('rekomendasi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('development_reports');
    }
};
