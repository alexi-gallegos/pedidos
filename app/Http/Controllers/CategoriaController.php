<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Categoria;

use App\Http\Requests\FoodRequest;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $categorias = Categoria::where('estado','1')->get();

        return $categorias;

    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FoodRequest $request)
    {
        
        $category = new Categoria;
        $category->descripcion = $request->category['descripcion'];
        $category->estado = 1;
        $category->save();
        
        return;

    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FoodRequest $request, $id)
    {
        
        if($request->delete['delete'] == 1){
            $category = Categoria::find($id);
            $category->estado = 0;
            $category->save();

            return;

            }else{

            $category = Categoria::find($id);
            $category->descripcion = $request->category['descripcion'] ;
            $category->estado = 1 ;
            $category->save();
        
                return;
        }

    }

    
}
