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
        Schema::create('form_pengajuan', function (Blueprint $table) {
            $table->bigIncrements('no_fp'); // Primary key dengan auto increment
            $table->unsignedBigInteger('id_output'); // Foreign key ke tabel Output
            $table->unsignedInteger('kode_komponen'); // Foreign key ke tabel Komponen
            $table->unsignedInteger('kode_subkomponen'); // Foreign key ke tabel SubKomponen
            $table->unsignedInteger('kode_akun'); // Foreign key ke tabel AkunBelanja
            $table->date('tanggal_mulai'); // Tanggal mulai
            $table->date('tanggal_akhir'); // Tanggal akhir
            $table->string('no_sk', 50)->nullable(); // No SK, opsional
            $table->text('uraian')->nullable(); // Uraian, opsional
            $table->decimal('nominal', 15, 2); // Nominal, max 15 digit, 2 desimal
            $table->string('nip_pengaju', 20); // Foreign key ke tabel Pegawai

            // Foreign key constraints
            $table->foreign('id_output')->references('id')->on('output');
            $table->foreign('kode_komponen')->references('kode')->on('komponen');
            $table->foreign('kode_subkomponen')->references('kode')->on('subkomponen');
            $table->foreign('kode_akun')->references('kode')->on('akun_belanja');
            $table->foreign('nip_pengaju')->references('nipbaru')->on('pegawai');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_pengajuan');
    }
};
