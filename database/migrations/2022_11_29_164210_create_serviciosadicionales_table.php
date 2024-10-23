<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiciosadicionalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('serviciosadicionales')) {
        Schema::create('serviciosadicionales', function (Blueprint $table) {
            $table->id('id_servicio_adicional');
            $table->integer('banio');
            $table->integer('otro');
            $table->integer('ninguno');
            $table->integer('zona_wifi');
            $table->integer('musica_vivo');
            $table->integer('pagos_digitales');
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
        Schema::dropIfExists('serviciosadicionales');
    }
}
