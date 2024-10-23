<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Otrosservicios extends Model
{
    use HasFactory;

    protected $table = 'otrosservicios';
    protected $fillable = ['id',
                            'nombre',
                            'telefono',
                            'horario',
                            'link',
                            'direccion',
                            'descripcion',
                            'tiposservicio'];
    protected $primaryKey = 'id';
    public $timestamps = false;

}
