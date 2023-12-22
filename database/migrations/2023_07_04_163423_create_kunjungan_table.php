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
        Schema::create('kunjungan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_rute')->constrained('rute')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('id_customer')->constrained('customer')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('id_status_kunjungan')->nullable()->constrained('status_kunjungan')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('id_alasan_batal')->nullable()->constrained('alasan_batal')->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('kunjungan');
    }
};
