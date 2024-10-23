<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatrimonioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('patrimonio')) {
        Schema::create('patrimonio', function (Blueprint $table) {
            $table->id('id_patrimonio');
            $table->string('nombre');
            $table->string('descripcion');
            $table->date('fecha_creacion');
            $table->string('direccion');
            $table->string('link_ruta');
            $table->integer('tipo_patrimonio');
            $table->timestamps();
        });
    }}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patrimonio');
    }
}
