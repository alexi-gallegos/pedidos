<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    protected $fillable = ['cargo','descripcion','estado'];

    public function trabajador(){
        return $this->belongsTo(Trabajador::class,'id');
    }
}
