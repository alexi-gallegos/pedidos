<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trabajador extends Model
{

    protected $table = "trabajadores";

    protected $fillable = ['rut','nombres','apellido_paterno','apellido_materno',
                            'direccion','telefono','nombre_contacto_emergencia',
                            'numero_contacto_emergencia','cargo_id','estado'];

    public function cargo(){
        return $this->belongsTo(Cargo::class);
    }
    public function user(){
        return $this->hasOne(User::class);
    }
}
