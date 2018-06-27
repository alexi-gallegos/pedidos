<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{

    protected $table = "menus";

    protected $fillable = ['descripcion','estado'];


    public function productos(){
        return $this->belongsToMany(Producto::class)
        ->withPivot(['cantidad','valor_unidad','valor_total']);
    }
}
