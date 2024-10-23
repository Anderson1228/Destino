<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendario extends Model
{
    use HasFactory;
    protected $table = 'calendario';
    protected $fillable = ['id', 'titulo',
    'descripcion','direccion','ruta'];
        public $timestamps = false;
        protected $primaryKey = 'id';
}
