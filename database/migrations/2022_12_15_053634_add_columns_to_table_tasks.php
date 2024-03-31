<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToTableTasks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->string('jamlak_name')->nullable();
            $table->string('kontrak_name')->nullable();
            $table->string('jamuk_name')->nullable();
            $table->string('sprin_pc_name')->nullable();
            $table->string('pc_name')->nullable();
            $table->string('izin_bekal_name')->nullable();
            $table->string('sprin_komisi_name')->nullable();
            $table->string('bek_name')->nullable();
            $table->string('komisi_name')->nullable();
            $table->string('bagudang_name')->nullable();
            $table->string('pem_gudang_name')->nullable();
            $table->string('bast_name')->nullable();
            $table->string('lpp_name')->nullable();
            $table->string('pemerataan_name')->nullable();

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
            $table->dropColumn('jamlak_name');
            $table->dropColumn('kontrak_name');
            $table->dropColumn('jamuk_name');
            $table->dropColumn('sprin_pc_name');
            $table->dropColumn('pc_name');
            $table->dropColumn('izin_bekal_name');
            $table->dropColumn('sprin_komisi_name');
            $table->dropColumn('bek_name');
            $table->dropColumn('komisi_name');
            $table->dropColumn('bagudang_name');
            $table->dropColumn('pem_gudang_name');
            $table->dropColumn('bast_name');
            $table->dropColumn('lpp_name');
            $table->dropColumn('pemerataan_name');
        });
    }
}
