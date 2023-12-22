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
        Schema::table('rute', function (Blueprint $table) {
            $table->string('hari')->after('customer_id');
            $table->string('minggu_ke')->after('hari');
            $table->string('ganjil_genap')->after('minggu_ke');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rute', function (Blueprint $table) {
            //
        });
    }
};
