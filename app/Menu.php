<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{

    protected $table = "menus";

    protected $fillable = ['descripcion','estado'];


    public function productos(){
        return $this->hasMany(Productos::class);
    }
}
