<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = ['nombre_producto','valor_unidad','categoria_id','estado'];


    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }

    public function pedidos(){
        return $this->belongsToMany(Pedido::class);
    }
}
