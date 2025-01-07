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
        Schema::create('form_keuangan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_form_pengajuan');
            $table->string('nip_pengawas', 9);
            $table->string('no_spby', 50);
            $table->string('no_drpp', 50);
            $table->string('no_spm', 50);
            $table->date('tanggal_drpp');
            $table->date('tanggal_spm');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('id_form_pengajuan')->references('id')->on('form_pengajuan');
            $table->foreign('nip_pengawas')->references('nip_lama')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_keuangan');
    }
};
