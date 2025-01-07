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
            $table->id();
            $table->string('no_fp', 10);
            $table->unsignedBigInteger('id_output');
            $table->unsignedBigInteger('id_komponen');
            $table->unsignedBigInteger('id_subkomponen');
            $table->unsignedBigInteger('id_akun_belanja');
            $table->date('tanggal_mulai');
            $table->date('tanggal_akhir');
            $table->string('no_sk', 50);
            $table->text('uraian');
            $table->decimal('nominal', 15, 0);
            $table->string('nip_pengaju', 9);
            $table->unsignedBigInteger('id_status')->default('1');
            $table->timestamps();


            // Foreign key constraints
            $table->foreign('id_output')->references('id')->on('output');
            $table->foreign('id_komponen')->references('id')->on('komponen');
            $table->foreign('id_subkomponen')->references('id')->on('sub_komponen');
            $table->foreign('id_akun_belanja')->references('id')->on('akun_belanja');
            $table->foreign('nip_pengaju')->references('nip_lama')->on('users');
            $table->foreign('id_status')->references('id')->on('status_pengajuan');
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
