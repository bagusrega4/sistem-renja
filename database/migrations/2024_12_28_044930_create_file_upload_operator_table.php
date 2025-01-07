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
        Schema::create('file_upload_operator', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_form_pengajuan');
            $table->unsignedBigInteger('id_akun_file_operator');
            $table->string('nip_pengaju', 9);
            $table->string('file');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('id_form_pengajuan')->references('id')->on('form_pengajuan');
            $table->foreign('id_akun_file_operator')->references('id')->on('akun_file_operator');
            $table->foreign('nip_pengaju')->references('nip_lama')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('file_upload_operator');
    }
};
