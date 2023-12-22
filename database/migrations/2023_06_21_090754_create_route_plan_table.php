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
        Schema::create('route_plan', function (Blueprint $table) {
            $table->id();
            $table->string('kode');
            $table->foreignId('id_sales')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('hari');
            $table->string('minggu_ke');
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
        Schema::dropIfExists('route_plan');
    }
};
