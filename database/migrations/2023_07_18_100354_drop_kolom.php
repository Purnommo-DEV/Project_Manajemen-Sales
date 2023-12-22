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
        Schema::table('detail_insentif', function (Blueprint $table) {
            $table->dropColumn('foto_bukti_insentif');
        });
        Schema::table('detail_retur', function (Blueprint $table) {
            $table->dropColumn('foto_bukti_insentif');
        });
        Schema::table('detail_transaksi', function (Blueprint $table) {
            $table->dropColumn('foto_bukti_insentif');
        });
        Schema::table('stok_visibility', function (Blueprint $table) {
            $table->dropColumn('foto_bukti_insentif');
            $table->dropConstrainedForeignId('kondisi_pemajangan_id');
            $table->dropColumn('catatan');
        });

        Schema::table('kunjungan', function (Blueprint $table) {
            $table->dropColumn('foto_bukti_insentif');
            $table->dropColumn('foto_bukti_retur');
            $table->dropColumn('foto_bukti_transaksi');
            $table->dropColumn('foto_bukti_stok_visibility');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
