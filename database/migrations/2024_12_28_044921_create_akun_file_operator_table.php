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
        Schema::create('akun_file_operator', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_akun_belanja');
            $table->unsignedBigInteger('id_jenis_file_operator');

            // Foreign key constraints
            $table->foreign('id_akun_belanja')->references('id')->on('akun_belanja');
            $table->foreign('id_jenis_file_operator')->references('id')->on('jenis_file_operator');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akun_file_operator');
    }
};
