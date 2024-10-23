<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCafeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('cafe')) {
        Schema::create('cafe', function (Blueprint $table) {
            $table->id('id_cafe');
            $table->string('nombre');
            $table->string('direccion');
            $table->string('historia');
            $table->string('horario_atencion');
            $table->string('origen_cafe');
            $table->string('pagina_web');
            $table->date('fecha_registro');
            $table->date('fecha_actualizado');
            $table->unsignedInteger('fk_id_menu');
            $table->foreign('fk_id_menu')->references('id_menu')->on('menu');
            $table->unsignedInteger('fk_id_servivio_adicional');
            $table->foreign('fk_id_servivio_adicional')->references('id_servicio_adicional')->on('serviciosadicionales');
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
        Schema::dropIfExists('cafe');
    }
}
