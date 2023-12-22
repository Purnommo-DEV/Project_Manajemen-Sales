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
        Schema::create('area', function (Blueprint $table) {
            $table->id();
            $table->string('kode');
            $table->foreignId('provinsi_id')->coinstrained('indonesia_provinces')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('kota_id')->coinstrained('indonesia_cities')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('kecamatan_id')->coinstrained('indonesia_districts')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('desa_id')->coinstrained('indonesia_villages')->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('area');
    }
};
