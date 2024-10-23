<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cafe extends Model
{
    use HasFactory;
     //Campos que llenaremos
     protected $fillable = ['nombre','direccion','historia','horario_atencion',
     'origen_cafe','pagina_web'];
}
