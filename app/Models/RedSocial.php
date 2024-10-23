<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RedSocial extends Model
{
    use HasFactory;

    protected $table = 'red_social';
    protected $fillable = ['id','link_red','fk_id_cafe'];
    protected $primaryKey = 'id';
    public $timestamps = false;

}
