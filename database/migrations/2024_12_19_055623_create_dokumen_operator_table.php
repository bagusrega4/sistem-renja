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
        Schema::create('dokumen_operator', function (Blueprint $table) {
            $table->id();
            $table->string('no_fp')->unique();
            $table->json('kode_akun_belanja'); // Stores array of account codes
            $table->string('dokumen_1');
            $table->string('dokumen_2');
            $table->string('dokumen_3');
            $table->timestamps(); // Adds created_at and updated_at columns

            // Foreign key constraints
            $table->foreign('no_fp')->references('no_fp')->on('form_pengajuan')->onDelete('cascade');
            $table->foreign('kode_akun_belanja')->references('kode')->on('akun_belanja')->onDelete('cascade');
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
