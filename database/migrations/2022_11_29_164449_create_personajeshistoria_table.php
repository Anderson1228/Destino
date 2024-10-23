<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonajeshistoriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('personajeshistoria')) {
        Schema::create('personajeshistoria', function (Blueprint $table) {
            $table->id('id_personaje');
            $table->string('nombre');
            $table->date('fecha_nacimiento');
            $table->string('descripcion');
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
        Schema::dropIfExists('personajeshistoria');
    }
}
