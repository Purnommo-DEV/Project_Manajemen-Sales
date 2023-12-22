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
        Schema::create('bppbm_status', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_bppbm')->constrained('bppbm')->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('id_status_bppbm_awal')->constrained('status_bppbm_awal')->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('id_status_bppbm_akhir')->constrained('status_bppbm_akhir')->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('bppbm_status');
    }
};
