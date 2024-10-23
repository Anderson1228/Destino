<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Festival extends Model
{
    use HasFactory;

    protected $table = 'festival';
    protected $fillable = ['id','fk_id_user','fk_id_hamburguesa','fk_id_voto'];


}
