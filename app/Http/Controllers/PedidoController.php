<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Pedido;

use App\Mesa;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $desde = $request->dateFrom;
        $hasta = $request->dateTo;
        
        if($request->action == 3){
        
            $pedidos = Pedido::with(['trabajador','estado_pedido','mesa','productos']) //pedidos finalizados
                                    ->where('estado_pedido_id','3')
                                    ->orderBy('created_at','DESC')
                                    ->paginate(10);

        }elseif($request->action == 4){

            $pedidos = Pedido::with(['trabajador','estado_pedido','mesa','productos']) //pedidos pendientes busqueda por fechas
                              ->whereBetween('estado_pedido_id',['1','2'])
                              ->where('created_at', '>=', $desde)
                              ->where('created_at', '<=', $hasta)
                              ->orderBy('created_at','DESC')
                              ->get();

        }elseif($request->action == 0){

            $pedidos = Pedido::with(['trabajador','estado_pedido','mesa','productos']) //pedidos finalizados busqueda por fechas
            ->where('estado_pedido_id','3')
            ->where('created_at', '>=', $desde)
            ->where('created_at', '<=', $hasta)
            ->orderBy('created_at','DESC')
            ->get();
        
        }elseif($request->action == 5){
            $pedidos = Pedido::with(['trabajador','estado_pedido','mesa','productos']) //pedidos pendientes
                                    ->whereBetween('estado_pedido_id',[1,2])
                                    ->orderBy('created_at','DESC')
                                    ->paginate(10);
                                    
        }elseif($request->action == 6){
            $pedidos = Pedido::with(['trabajador','estado_pedido','mesa','productos']) //pedidos pendientes
                                    ->where('trabajador_id', $request->id_worker)
                                    ->whereBetween('estado_pedido_id',[1,2])
                                    ->orderBy('created_at','DESC')
                                    ->paginate(10);
        }elseif($request->action == 7){
            $pedidos = Pedido::with(['trabajador','estado_pedido','mesa','productos']) //pedidos finalizados
                                    ->where('estado_pedido_id','3')
                                    ->where('trabajador_id',$request->id_worker)
                                    ->orderBy('created_at','DESC')
                                    ->paginate(10);
        }elseif($request->action == 8){
            $pedidos = Pedido::with(['trabajador','estado_pedido','mesa','productos']) //pedidos finalizados busqueda por fechas y trabajador individual
            ->where('estado_pedido_id','3')
            ->where('trabajador_id',$request->id_worker)
            ->where('created_at', '>=', $desde)
            ->where('created_at', '<=', $hasta)
            ->orderBy('created_at','DESC')
            ->get();
        }elseif($request->action == 9){
            $pedidos = Pedido::with(['trabajador','estado_pedido','mesa','productos']) //pedidos pendientes busqueda por fechas
            ->whereBetween('estado_pedido_id',['1','2'])
            ->where('trabajador_id',$request->id_worker)
            ->where('created_at', '>=', $desde)
            ->where('created_at', '<=', $hasta)
            ->orderBy('created_at','DESC')
            ->get();

        }

        if($request->action == 4 || $request->action == 0 || $request->action == 8 || $request->action == 9){

                return $pedidos;

        }else{
                return [
                    'pagination' => [
                        'total'         => $pedidos->total(),
                        'current_page'  => $pedidos->currentPage(),
                        'per_page'      => $pedidos->perPage(),
                        'last_page'     => $pedidos->lastPage(),
                        'from'          => $pedidos->firstItem(),
                        'to'            => $pedidos->lastItem(),
                    ],
                    'pedidos' => $pedidos
                ];
        }

    }

 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        if($request->action == 2){
            $pedido = Pedido::find($request->id);
            $pedido->estado_pedido_id = 2;
            $pedido->save();
        }elseif($request->action == 3){
            $pedido = Pedido::find($request->id);
            $pedido->estado_pedido_id = 3;
            $pedido->save();

            $mesa = Mesa::find($request->mesa);
            $mesa->disponible = 1 ;
            $mesa->save(); 
        }

        return;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
