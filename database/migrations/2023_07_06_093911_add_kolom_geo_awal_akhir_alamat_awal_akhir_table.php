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
        Schema::table('perjalanan', function (Blueprint $table) {
            $table->text('geo_awal')->after('kendaraan_id')->nullable();
            $table->text('alamat_awal')->after('geo_awal')->nullable();
            $table->text('geo_akhir')->after('alamat_awal')->nullable();
            $table->text('alamat_akhir')->after('geo_akhir')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('perjalanan', function (Blueprint $table) {
            //
        });
    }
};
