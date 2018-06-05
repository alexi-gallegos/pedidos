<?php

namespace App\Http\Controllers;

use App\Pedido;

use App\PedidoProducto;

use Illuminate\Http\Request;

class ChartController extends Controller
{

    public function today(Request $request){

        $desde = $request->desde;
        $hasta = $request->hasta;

        $total = Pedido::with(['estado_pedido','productos']) //contar la cantidad total de cada producto vendido ejemplo : 10 completos en el dia, 20 bebidas 250 ml., etc.
                ->where('estado_pedido_id','3')
                ->where('created_at', '>=', $desde)
                ->where('created_at', '<=', $hasta)
                ->orderBy('created_at','DESC')
                ->get();

        $tots = 0;
        $producs = [];
        $valor_total = 0;
        $total_producto = [];

        foreach ($total as $producto) {
            $length = count($producto->productos);
            $cantidad = $producto->productos;


            for ($i=0; $i < $length ; $i++) { 
                
                $tots += $cantidad[$i]->pivot->cantidad;
                $name = $cantidad[$i]->nombre_producto;
                $valor_total += $cantidad[$i]->pivot->valor_total;

                if (array_key_exists($name, $producs)){
                    $producs[$name] = $producs[$name] + $cantidad[$i]->pivot->cantidad;
                    $total_producto[$name] +=  $cantidad[$i]->pivot->valor_total;
                }else{
                    $producs[$name] = $cantidad[$i]->pivot->cantidad;
                    $total_producto[$name] = $cantidad[$i]->pivot->valor_total;
                }

            }

        }

        

        if($total->isEmpty()){
            return 0;
        }

        $send = [$producs,$valor_total,$total_producto];
        //$send = [$hasta,$desde];



        return $send;



    }

}
