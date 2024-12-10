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
            $table->kegiatan();
            $table->kro();
            $table->ro();
            $table->output();
            $table->flag();
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
