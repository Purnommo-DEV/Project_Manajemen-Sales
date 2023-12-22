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
        Schema::create('catatan_keuangan', function (Blueprint $table) {
            $table->id();
            $table->string('tanggal');
            $table->foreignId('jenis_id')->constrained('jenis_transaksi')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('kategori_id')->constrained('kategori_catatan_keuangan')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('nominal');
            $table->text('keterangan');
            $table->text('foto_bukti');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catatan_keuangan');
    }
};
