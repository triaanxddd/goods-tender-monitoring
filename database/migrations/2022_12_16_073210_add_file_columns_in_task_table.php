<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFileColumnsInTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->string('file_jamlak')->nullable();
            $table->string('file_kontrak')->nullable();
            $table->string('file_jamuk')->nullable();
            $table->string('file_sprin_pc')->nullable();
            $table->string('file_pc')->nullable();
            $table->string('file_izin_bekal')->nullable();
            $table->string('file_sprin_komisi')->nullable();
            $table->string('file_bek')->nullable();
            $table->string('file_komisi')->nullable();
            $table->string('file_bagudang')->nullable();
            $table->string('file_pem_gudang')->nullable();
            $table->string('file_bast')->nullable();
            $table->string('file_lpp')->nullable();
            $table->string('file_pemerataan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn('file_jamlak');
            $table->dropColumn('file_kontrak');
            $table->dropColumn('file_jamuk');
            $table->dropColumn('file_sprin_pc');
            $table->dropColumn('file_pc');
            $table->dropColumn('file_izin_bekal');
            $table->dropColumn('file_sprin_komisi');
            $table->dropColumn('file_bek');
            $table->dropColumn('file_komisi');
            $table->dropColumn('file_bagudang');
            $table->dropColumn('file_pem_gudang');
            $table->dropColumn('file_bast');
            $table->dropColumn('file_lpp');
            $table->dropColumn('file_pemerataan');
        });
    }
}
