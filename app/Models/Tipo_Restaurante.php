<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo_Restaurante extends Model
{
    use HasFactory;
    protected $table = 'tiporestaurante';
   protected $fillable = ['id_tipo_res','nombre','tipo_res'];
     protected $primaryKey = 'id_tipo_res';
  
     //NO FECHAS AUTOMATICAS
     public $timestamps = false;
}
