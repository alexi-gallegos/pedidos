<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Trabajador;

use App\Http\Requests\WorkerRequest;

class TrabajadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $worker = Trabajador::with('cargo')->where('estado','1')->get();

        return $worker;

    }

 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WorkerRequest $request)
    {
        
        $worker = new Trabajador;
        $worker->rut = $request->worker['rut'] ;
        $worker->nombres = $request->worker['nombres'] ;
        $worker->apellido_paterno = $request->worker['apellido_p'] ;
        $worker->apellido_materno = $request->worker['apellido_m'] ;
        $worker->direccion = $request->worker['direccion'] ;
        $worker->telefono = $request->worker['telefono'] ;
        $worker->nombre_contacto_emergencia = $request->worker['nombre_emergencia'] ;
        $worker->numero_contacto_emergencia = $request->worker['telefono_emergencia'] ;
        $worker->cargo_id = $request->worker['cargo'] ;
        $worker->estado = 1 ;
        $worker->save();

        return;
    }

 
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(WorkerRequest $request, $id)
    {
        
        if($request->delete['delete'] == 1){
            $worker = Trabajador::find($id);
            $worker->estado = 0;
            $worker->save();

            return;

            }else{

            $worker = Trabajador::find($id);
            $worker->rut = $request->worker['rut'] ;
            $worker->nombres = $request->worker['nombres'] ;
            $worker->apellido_paterno = $request->worker['apellido_p'] ;
            $worker->apellido_materno = $request->worker['apellido_m'] ;
            $worker->direccion = $request->worker['direccion'] ;
            $worker->telefono = $request->worker['telefono'] ;
            $worker->nombre_contacto_emergencia = $request->worker['nombre_emergencia'] ;
            $worker->numero_contacto_emergencia = $request->worker['telefono_emergencia'] ;
            $worker->cargo_id = $request->worker['cargo'] ;
            $worker->estado = 1 ;
            $worker->save();
        
                return;
        }

    }

}
