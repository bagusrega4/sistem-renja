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
            $table->unsignedBigInteger('id_kegiatan');
            $table->unsignedBigInteger('id_kro');
            $table->string('kode_ro', 3);
            $table->string('output', 255);
            $table->boolean('flag')->default(1);

            // Foreign key constraints
            $table->foreign('id_kegiatan')->references('id')->on('kegiatan');
            $table->foreign('id_kro')->references('id')->on('kro');
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
