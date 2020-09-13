<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // 1 post pertenece a 1 usuario relacion de 1 a 1 entonces ira en singular

    public function user(){

        return $this->belongsTo(User::class);
    }

    //funcion para controlar los datos que sean en mayusculas, 
    //strtoupper metodo para transformar a mayusculas
    //ucfirst metodo para que la primera letra sea en mayusculas y las otras en minúsculas

        public function getGetTitleAttribute(){

            return ucfirst($this->title);
        }

    //Para que la configuración se refleje en la base de datos hago el siguiente método
    // este metodo de php: strtolower me permite guardar los datos en la base de datos pero en Minùsculas
    public function setTitleAttribute($value){

        $this->attributes['title'] = strtolower($value);
    }
}