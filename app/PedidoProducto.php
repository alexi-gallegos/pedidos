<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PedidoProducto extends Model
{
    protected $table= "pedido_producto";

    protected $fillable = ['pedido_id','producto_id','valor','cantidad','estado'];

    
}
