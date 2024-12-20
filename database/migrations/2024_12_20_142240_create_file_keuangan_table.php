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
        Schema::create('file_keuangan', function (Blueprint $table) {
            $table->id();
            $table->integer('fileOperatorId');
            $table->string('noSPBy', 50);
            $table->string('noDRPP', 50);
            $table->string('noSPM', 50);
            $table->date('tanggal_SPM');
            $table->date('tanggal_DRPP');
            $table->string('buktiTransfer');
            $table->string('spjHonorInnas');
            $table->string('sspHonorInnas');
            $table->string('fileLainya');

            $table->foreign('fileOperatorId')->references('id')->on('file_operator');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('file_keuangan');
    }
};
