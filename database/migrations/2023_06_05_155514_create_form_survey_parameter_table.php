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
        Schema::create('form_survey_parameter', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->foreignId('form_survey_id')->constrained('form_survey')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('label');
            $table->string('category');
            $table->string('sequence');
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
        Schema::dropIfExists('form_survey_parameter');
    }
};
