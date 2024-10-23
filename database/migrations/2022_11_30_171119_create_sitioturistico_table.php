<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSitioturisticoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('sitioturistico')) {
        Schema::create('sitioturistico', function (Blueprint $table) {
            $table->id('id_sitio');
            $table->string('nombre');
            $table->string('ciudad');
            $table->unsignedInteger('fk_id_tipo_sitio_tu');
            $table->foreign('fk_id_tipo_sitio_tu')->references('id_tipo_sitio_tu')->on('tipositioturistico');           
            $table->unsignedInteger('fk_id_ruta2');
            $table->foreign('fk_id_ruta2')->references('id_ruta')->on('ruta');
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
        Schema::dropIfExists('sitioturistico');
    }
}
