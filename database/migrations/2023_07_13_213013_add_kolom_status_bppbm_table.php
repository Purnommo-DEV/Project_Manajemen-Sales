<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bppbm', function (Blueprint $table) {
            $table->foreignId('id_status_bppbm_awal')->after('remark')->constrained('bppbm_status')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('id_status_bppbm_akhir')->after('id_status_bppbm_awal')->constrained('bppbm_status')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bppbm', function (Blueprint $table) {
            //
        });
    }
};
