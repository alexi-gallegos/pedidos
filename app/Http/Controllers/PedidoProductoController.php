<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\PusherController;

use App\PedidoProducto;

use App\Pedido;

use App\Mesa;

class PedidoProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $pusher = new PusherController;
            // agregar pedido a la tabla pedidos
            $pedido = new Pedido;
            $pedido->valor_total = $request['total'];
            $pedido->trabajador_id = $request['id_trabajador'];
            $pedido->mesa_id = $request['mesa'];

            $pedido->estado = 1;
            $pedido->estado_pedido_id = 1 ;
            $pedido->save();

            //cambiar el estado de la mesa a "no disponible"

            $mesa = mesa::find($request['mesa']);
            $mesa->disponible = 0;
            $mesa->save();

            //calcular ultimo pedido
            $id_pedido = Pedido::latest()->first();
            $id = $id_pedido->id;

            //agregar cada producto del pedido a la tabla pedido_producto, vinculado mediante el id de la tabla pedido
            foreach ($request->pedido as $pedido) {
               $pedido_producto = new Pedidoproducto;
               $pedido_producto->pedido_id = $id;
               $pedido_producto->producto_id = $pedido['id'];
               $pedido_producto->cantidad = $pedido['cantidad'];
               $pedido_producto->valor_unidad = $pedido['valor_unidad'];
               $pedido_producto->valor_total = $pedido['valor_total'];
               $pedido_producto->estado = 1;
               $pedido_producto->save();

            }


        $datos = $request->pedido;
        $datos = [$datos,$id];
        $push = $pusher->sendNotification($datos);
        return $push;

    }

   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

 
}
