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
        Schema::create('route_plan_customer', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_route_plan')->constrained('route_plan')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('id_customer')->constrained('customer')->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('route_plan_customer');
    }
};
