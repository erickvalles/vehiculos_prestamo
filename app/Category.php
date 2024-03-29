<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;

class Category extends Model
{
    protected $fillable = ['nombre'];
    //mutador
    //mb_strtolower minusculas
    public function setNombreAttribute($valor){
        $this->attributes['nombre'] = mb_strtolower($valor);
    }
    //accesor
    //ucwords cada palabra la primer letra, la pone en mayúsculas, ucfirst solo la primer letra de toda la frase la pone en mayúsculas.
    public function getNombreAttribute($valor){
        return ucfirst($valor);
    }

    public function event_types(){
        return $this->hasMany(Event_Type::class,'categories_id','id');
    }
}
