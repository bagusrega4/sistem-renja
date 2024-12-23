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
        Schema::table('file_operator', function (Blueprint $table) {
            $table->string('catatan', 100)->nullable()->after('rekap_norek_innas');
            $table->string('bukti_transfer')->nullable()->after('catatan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('file_oparator', function (Blueprint $table) {
            $table->dropColumn('catatan');
            $table->dropColumn('bukti_transfer');
        });
    }
};
