<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    //
    protected $fillable = ['id', 'dependencies_id', 'nombre', 'apaterno', 'amaterno', 'celular'];

    public function contact() {
        return $this->belongsTo(Contact::class);
    }
}
