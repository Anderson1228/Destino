<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSenderismoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('senderismo')) {
        Schema::create('senderismo', function (Blueprint $table) {
            $table->id('id_senderismo');
            $table->string('nombre');
            $table->string('descripcion');
            $table->string('link_ubicacion');
            $table->string('caracteristica');
            $table->integer('cicla');
            $table->integer('moto');
            $table->integer('caminando');
            $table->integer('carro');
            $table->integer('tipo_turismo');
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
        Schema::dropIfExists('senderismo');
    }
}
