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
        Schema::create('pesan_produk_transaksi', function (Blueprint $table) {
            $table->id();
            $table->string('kode');
            $table->foreignId('perusahaan_id')->constrained('perusahaan')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('kode_po')->nullable();
            $table->string('total_pembayaran')->nullable();
            $table->text('lampiran')->nullable();
            $table->string('tanggal');
            $table->string('status')->nullable();
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
        Schema::dropIfExists('pesan_produk_transaksi');
    }
};
