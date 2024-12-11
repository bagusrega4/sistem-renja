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
        Schema::create('sub_komponen', function (Blueprint $table) {
            $table->id();
            $table->char('kode', 1)->unique();
            $table->string('sub_komponen', 100);
            $table->boolean('flag')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_komponen');
    }
};
