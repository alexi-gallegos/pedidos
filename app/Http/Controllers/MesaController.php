<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mesa;

use App\Http\Requests\MesaRequest;

class MesaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->id == 1){
        
            $mesas = Mesa::where([
                ['estado','1'],
                ['disponible','1']
                ])->get();

        }else{
        
            $mesas = Mesa::where('estado','1')->get();

        }

        return $mesas;
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MesaRequest $request)
    {
        if(Mesa::where('numero_mesa', '=', $request->table['numero_mesa'])->count() > 0) {
            return 1;
         }else{
        $mesa = new Mesa;
        $mesa->numero_mesa = $request->table['numero_mesa'];
        $mesa->save();
        
        return;

        }
        
        
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MesaRequest $request, $id)
    {
        
        if($request->delete['delete'] == 1){
            $mesa = Mesa::find($id);
            $mesa->estado = 0;
            $mesa->save();

            return;

            }else{

            $mesa = Mesa::find($id);
            $mesa->numero_mesa = $request->table['numero_mesa'] ;
            $mesa->disponible = $request->table['disponible'];
            $mesa->estado = 1 ;
            $mesa->save();
        
                return;
        }

    }

}
