<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('form_pengajuan', function (Blueprint $table) {
            $table->text('rejection_note')->nullable()->after('id_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('form_pengajuan', function (Blueprint $table) {
            $table->dropColumn('rejection_note');
        });
    }
};
