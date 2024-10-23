<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNuestrahistoriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('nuestrahistoria')) {
        Schema::create('nuestrahistoria', function (Blueprint $table) {
            $table->id('id_historia');
            $table->string('title');
            $table->string('descripcion');
            $table->string('link_ubicacion');
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
        Schema::dropIfExists('nuestrahistoria');
    }
}
