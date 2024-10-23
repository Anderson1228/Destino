<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Senderismo extends Model
{
    use HasFactory;
    protected $fillable = ['nombre','descripcion','caracteristica','link_ubicacion'];
}
