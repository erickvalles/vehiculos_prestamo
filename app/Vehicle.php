<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable =['placas', 'nombre', 'capacidad', 'estado'];
}
