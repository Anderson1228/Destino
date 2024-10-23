<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Multimedia extends Model
{
    use HasFactory;
    
    protected $table = 'multimedia';
    protected $fillable = ['id_multi','link_foto','link_video','fk_id_res3','fk_id_plato2','fk_id_cafe','fk_id_personaje', 'fk_id_historia', 'fk_id_senderismo', 'fk_id_servicio', 'fk_id_calendario', 'fk_id_hamburguesas'];
    protected $primaryKey = 'id_multi';
    public $timestamps = false;
}
