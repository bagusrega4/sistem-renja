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
        Schema::create('akun_belanja', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 6)->unique();
            $table->string('akun_belanja', 255);
            $table->boolean('flag')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akun_belanja');
    }
};
