<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Producto;

use App\Http\Requests\ProductoRequest;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $productos = Producto::with('categoria')
                               ->where('estado','1')
                               ->orderBy('categoria_id','ASC')
                               ->get();

        return $productos;

    }

    public function products(Request $request){

        $products = Producto::where([
                                ['categoria_id',$request->id],
                                ['estado','1'],
                                ])
                                ->get();
        
        return $products;
                            

    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductoRequest $request)
    {

            $product = new Producto;
            $product->nombre_producto = $request->product['nombre_producto'] ;
            $product->valor_unidad = $request->product['valor_unidad'];
            $product->categoria_id = $request->product['categoria_id']; ;
            $product->disponible = 1 ;
            $product->estado = 1;
            $product->save();

    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductoRequest $request, $id)
    {

        if($request->delete['delete'] == 1){
            $product = Producto::find($id);
            $product->estado = 0;
            $product->save();

            return;

            }else{

            $product = Producto::find($id);
            $product->nombre_producto = $request->product['nombre_producto'] ;
            $product->valor_unidad = $request->product['valor_unidad'];
            $product->categoria_id = $request->product['categoria_id']; ;
            $product->disponible = $request->product['disponibilidad'] ;
            $product->save();
        
                return;
        }
        
        
    }

}
