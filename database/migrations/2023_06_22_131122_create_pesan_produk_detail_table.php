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
        Schema::create('pesan_produk_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pesan_produk_transaksi_id')->constrained('pesan_produk_transaksi')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('nama_produk');
            $table->string('jumlah');
            $table->text('catatan');
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
        Schema::dropIfExists('pesan_produk_detail');
    }
};
