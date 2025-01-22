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
        Schema::table('form_pengajuan', function (Blueprint $table) {
            $table->unsignedBigInteger('id_fuo')->nullable();

            $table->foreign('id_fuo')->references('id_form_pengajuan')->on('file_upload_operator');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('form_pengajuan', function (Blueprint $table) {
            $table->dropColumn('id_fk');
        });
    }
};
