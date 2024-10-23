<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    //protected $fillable = [
      //  'name',
        //'email',
        //'password',
    //];
    protected $table = 'users'; 
    //Campos
    protected $fillable = ['id_user','nombre','estado','email','fecha_nacimiento','documento',
    'ciudad_residencia','tipo_usuario','password','fecha_registro','fecha_actualizado','remember_token','email_verified_at'];

    //personalizacion de las columnas de fechas
    const CREATED_AT = 'fecha_registro';
    const UPDATED_AT = 'fecha_actualizado';
    //PRIMAY KEY
    protected $primaryKey = 'id_user';
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
