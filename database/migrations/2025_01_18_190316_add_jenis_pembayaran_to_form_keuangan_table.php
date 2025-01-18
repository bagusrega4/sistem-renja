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
        Schema::table('form_keuangan', function (Blueprint $table) {
            $table->string('jenis_pembayaran', 50)->nullable()->after('nip_pengawas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('form_keuangan', function (Blueprint $table) {
            $table->dropColumn('jenis_pembayaran');
        });
    }
};
