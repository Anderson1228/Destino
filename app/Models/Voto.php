<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voto extends Model
{
    use HasFactory;
    protected $table = 'votos';
    protected $fillable = ['id','nombre'];
    protected $primaryKey = 'id';

    public $timestamps =false;
}
