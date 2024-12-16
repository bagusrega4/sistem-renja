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
            $table->bigIncrements('no_fp');
            $table->integer('id_output');
            $table->integer('kode_komponen');
            $table->char('kode_subkomponen');
            $table->string('kode_akun');
            $table->date('tanggal_mulai');
            $table->date('tanggal_akhir');
            $table->string('no_sk', 50);
            $table->text('uraian');
            $table->numeric('nominal', 15);
            $table->string('nip_pengaju', 20);

            // Foreign key constraints
            $table->foreign('kode_komponen')->references('kode')->on('komponen');
            $table->foreign('kode_subkomponen')->references('kode')->on('sub_komponen');
            $table->foreign('kode_akun')->references('kode')->on('akun_belanja');
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
