<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hamburguesa extends Model
{
    
    use HasFactory;
      //Campos que llenaremos
      // protected $table = 'hamburguesas';
      protected $fillable = ['id', 'restaurante','direccion','telefono','horario', 'ingredientes','nombre_hamburguesa', 'linkruta'];     
        // protected $primaryKey = 'id';
}
