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
        Schema::create('output', function (Blueprint $table) {
            $table->id();
            $table->integer('kode_kegiatan')->unique();
            $table->string('kode_kro', 3)->unique();
            $table->string('kode_ro', 3)->unique();
            $table->string('output', 255);
            $table->boolean('flag')->default(1);

            // Foreign key constraints
            $table->foreign('kode_kegiatan')->references('kode')->on('kegiatan');
            $table->foreign('kode_kro')->references('kode')->on('kro');
            $table->foreign('kode_ro')->references('kode')->on('ro');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('output');
    }
};
