<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRedSocialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('red_social')) {
        Schema::create('red_social', function (Blueprint $table) {
            $table->id();
            $table->string('link_red');
            $table->unsignedInteger('fk_id_cafe');
            $table->foreign('fk_id_cafe')->references('id_cafe')->on('cafe');
            $table->timestamps();
        });
    }
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('red_social');
    }
}
