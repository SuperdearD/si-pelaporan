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
        Schema::table('incidents', function (Blueprint $table) {
            $table->string('status_laporan')->default('Menunggu');
            $table->text('catatan_revisi_laporan')->nullable();
            $table->string('status_tindak_lanjut')->default('Menunggu');
            $table->text('catatan_revisi_tindak_lanjut')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('incidents', function (Blueprint $table) {
            $table->dropColumn([
                'status_laporan', 
                'catatan_revisi_laporan',
                'status_tindak_lanjut',
                'catatan_revisi_tindak_lanjut'
            ]);
        });
    }
};
