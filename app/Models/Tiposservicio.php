<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tiposservicio extends Model
{
    use HasFactory;
    use HasFactory;

    protected $table = 'tiposservicios';
    protected $fillable = ['id','nombre'];
    protected $primaryKey = 'id';
     //NO FECHAS AUTOMATICAS
    public $timestamps = false;
}
