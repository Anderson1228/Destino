<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonajesHistoricos extends Model
{
    use HasFactory;
    protected $fillable = ['nombre','fecha_nacimiento','descripcion'];
}
