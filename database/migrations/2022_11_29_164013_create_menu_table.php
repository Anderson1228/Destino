<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('menu')) {
        Schema::create('menu', function (Blueprint $table) {
            $table->id('id_menu');
            $table->integer('pasteleria');
            $table->integer('licores');
            $table->integer('comidas_rapidas');
            $table->integer('helados');
            $table->integer('otro');
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
        Schema::dropIfExists('menu');
    }
}
