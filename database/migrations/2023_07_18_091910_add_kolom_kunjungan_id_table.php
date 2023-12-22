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
            $table->foreignId('kunjungan_id')->after('id')->constrained('kunjungan')->cascadeOnDelete()->cascadeOnUpdate();
        });
        Schema::table('detail_retur', function (Blueprint $table) {
            $table->foreignId('kunjungan_id')->after('id')->constrained('kunjungan')->cascadeOnDelete()->cascadeOnUpdate();
        });
        Schema::table('detail_transaksi', function (Blueprint $table) {
            $table->foreignId('kunjungan_id')->after('id')->constrained('kunjungan')->cascadeOnDelete()->cascadeOnUpdate();
        });
        Schema::table('stok_visibility', function (Blueprint $table) {
            $table->foreignId('kunjungan_id')->after('id')->constrained('kunjungan')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('kondisi_pemajangan_id')->after('total_stok')->constrained('status_kondisi_pemajangan')->cascadeOnDelete()->cascadeOnUpdate();
            $table->text('catatan')->after('kondisi_pemajangan_id')->nullable();
        });

        Schema::table('kunjungan', function (Blueprint $table) {
            $table->text('foto_bukti_insentif')->nullable()->after('id_alasan_batal');
            $table->text('foto_bukti_retur')->nullable()->after('foto_bukti_insentif');
            $table->text('foto_bukti_transaksi')->nullable()->after('foto_bukti_retur');
            $table->text('foto_bukti_stok_visibility')->nullable()->after('foto_bukti_insentif');
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
