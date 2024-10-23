<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurante extends Model
{
    
    use HasFactory;
      //Campos que llenaremos
      protected $fillable = ['nombre','direccion','telefono','propietario'];
}
