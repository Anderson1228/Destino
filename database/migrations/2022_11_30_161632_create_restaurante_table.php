<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestauranteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('restaurante')) {
        Schema::create('restaurante', function (Blueprint $table) {
            $table->id('id_res');
            $table->string('nombre');
            $table->unsignedInteger('fk_id_tipo_res');
            $table->foreign('fk_id_tipo_res')->references('id_tipo_res')->on('tiporestaurante');
            $table->string('direccion');
            $table->string('telefono');
            $table->string('horario_atencion');
            $table->date('fecha_registro');
            $table->date('fecha_actualizado');
            $table->unsignedInteger('fk_id_ruta');
            $table->foreign('fk_id_ruta')->references('id_ruta')->on('ruta');
            $table->unsignedInteger('fk_id_plato');
            $table->foreign('fk_id_plato')->references('id_plato')->on('platoprincipal');
            $table->string('nombre_propietario');
            $table->string('mascota');
            $table->string('estado')->default(1);
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
        Schema::dropIfExists('restaurante');
    }
}
