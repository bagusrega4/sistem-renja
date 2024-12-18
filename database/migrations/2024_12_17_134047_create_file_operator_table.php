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
        Schema::create('file_operator', function (Blueprint $table) {
            $table->id();
            $table->string('no_fp')->unique();
            $table->text('nama_permintaan');
            $table->string('kak_ttd');
            $table->string('surat_tugas');
            $table->string('sk_kpa');
            $table->string('laporan_innas');
            $table->string('daftar_hadir');
            $table->string('absen_harian');
            $table->string('rekap_norek_innas');

            // Foreign key constraints
            $table->foreign('no_fp')->references('no_fp')->on('form_pengajuan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('file_operator');
    }
};
