<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = ['valor_total','trabajador_id','metodo_pago_id','estado_pedido_id','estado'];


    public function trabajador(){
        return $this->belongsTo(Trabajador::class,'trabajador_id'); //El segundo argumento,ID,  pertenece a la tabla trabajadores
    }

    public function estado_pedido(){
        return $this->belongsTo(EstadoPedido::class,'estado_pedido_id');
    }

    public function mesa(){
        return $this->belongsTo(Mesa::class,'mesa_id');
    }
    

    public function productos(){
        return $this->belongsToMany(Producto::class)
        ->withPivot(['cantidad','valor_unidad','valor_total']);
    }
}
