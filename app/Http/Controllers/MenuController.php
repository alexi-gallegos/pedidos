<?php

namespace App\Http\Controllers;

use App\Menu;

use App\MenuProducto;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::with('productos')
                        ->where('estado','1')
                        ->get();

        return $menus;
    }

   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        //crear nuevo menu
        $menu = new Menu;
        $menu->nombre_menu = $request['nombre_menu'];
        $menu->valor_total = $request['total'];
        $menu->save();

        //id del ultimo menu
        $id_menu = Menu::latest()->first();
        $id = $id_menu->id;

        //agregar cada producto del pedido a la tabla menu_producto, vinculado mediante el id de la tabla menu
        foreach ($request->productos as $menu_item) {
            $menu_producto = new MenuProducto;
            $menu_producto->menu_id = $id;
            $menu_producto->producto_id = $menu_item['id'];
            $menu_producto->cantidad = $menu_item['cantidad'];
            $menu_producto->valor_unidad = $menu_item['valor_unidad'];
            $menu_producto->valor_total = $menu_item['valor_total'];
            $menu_producto->estado = true;
            $menu_producto->save();

          }


            return "hecho";
        
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
