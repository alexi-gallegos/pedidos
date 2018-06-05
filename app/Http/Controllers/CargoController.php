<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Cargo;

use App\Http\Requests\PositionRequest;

class CargoController extends Controller
{

   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $cargos = Cargo::where('estado','1')->get();

        return $cargos;

    }

  

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PositionRequest $request)
    {
            $position = new Cargo;
            $position->cargo = $request->position['cargo'];
            $position->descripcion = $request->position['descripcion'];
            $position->estado=1;
            $position->save();

            return;
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PositionRequest $request, $id)
    {
        if($request->delete['delete'] == 1){
            $position = Cargo::find($id);
            $position->estado = 0;
            $position->save();

            return;

            }else{

            $position = Cargo::find($id);
            $position->cargo = $request->position['cargo'];
            $position->descripcion = $request->position['descripcion'];
            $position->save();

            return;
        }
    }

    
}
