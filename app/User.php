<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Relacion de 1 usuario con muchos posts para ello la funcion irá en plural:
    public function posts(){

        return $this->hasMany(Post::class);
    }

    //funcion para controlar los datos que sean en mayusculas, strtoupper metodo para transformar a mayusculas:
    // esta funcion solo se refleja en la vista
    public function getGetNameAttribute(){

        return strtoupper($this->name);
    }

    //Para que la configuración se refleje en la base de datos hago el siguiente método
    // este metodo de php: strtolower me permite guardar los datos en la base de datos pero en Minùsculas
    public function setNameAttribute($value){

        $this->attributes['name'] = strtolower($value);
    }
}
