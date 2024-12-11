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
            $table->unsignedBigInteger('id_output');
            $table->unsignedInteger('kode_komponen');
            $table->unsignedInteger('kode_subkomponen');
            $table->unsignedInteger('kode_akun');
            $table->date('tanggal_mulai');
            $table->date('tanggal_akhir');
            $table->string('no_sk', 50)->nullable();
            $table->text('uraian')->nullable();
            $table->decimal('nominal', 15, 2);
            $table->string('nip_pengaju', 20);

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
