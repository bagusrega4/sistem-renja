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
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->string('nip_lama', 20)->unique();
            $table->string('nip_baru', 20);
            $table->string('jabatan', 100);
            $table->string('kode_wilayah', 50);
            $table->string('nama_wilayah', 255);
            $table->string('golongan', 50);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai');
    }
};
