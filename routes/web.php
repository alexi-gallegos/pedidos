<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//rutas de auth, login, reset pass, etc
Auth::routes();

//ruta index
Route::get('/', function () {
    return view('index');
})->name('inicio')->middleware('guest');

// ruta index admin
Route::get('/admin',function(){
    return view('admin.index');
})->name('admin')->middleware('auth');

// ruta get de productos seleccionados de una categoria
Route::get('/admin/products_categories','ProductoController@products')->name('products_categories')->middleware('auth');

//Ruta de pedidos
Route::resource('admin/pedidos','PedidoProductoController')->except(['show','create','destroy','edit']);


// Ruta nueva orden
Route::get('/admin/nueva_orden',function(){
    return view('admin.nueva_orden.index');
})->name('nueva_orden')->middleware('auth');

//Rutas cargos **********************************************
Route::get('/admin/cargos',function(){
    return view('admin.cargos.index');
})->name('cargos')->middleware('auth','can:admin-only');

Route::resource('admin/position','CargoController')->except(['show','create','destroy','edit']);

//Rutas trabajadores ***********************************************
Route::get('/admin/trabajadores',function(){
    return view('admin.trabajadores.index');
})->name('trabajadores')->middleware('auth','can:admin-only');

Route::resource('admin/workers','TrabajadorController')->except(['show','create','destroy','edit']);

//Rutas Categorias ***********************************************
Route::get('/admin/categorias',function(){
    return view('admin.categorias.index');
})->name('categorias')->middleware('auth','can:admin-only');

Route::resource('admin/categories','CategoriaController')->except(['show','create','destroy','edit']);

//Rutas Productos ***********************************************
Route::get('/admin/productos',function(){
    return view('admin.productos.index');
})->name('productos')->middleware('auth','can:admin-only');

Route::resource('admin/products','ProductoController')->except(['show','create','destroy','edit']);

//Rutas Mesas ***********************************************
Route::get('/admin/mesas',function(){
    return view('admin.mesas.index');
})->name('mesas')->middleware('auth','can:admin-only');

Route::resource('admin/tables','MesaController')->except(['show','create','destroy','edit']);


//Pedidos pendientes,finalizados y cancelados
Route::get('admin/pedidos_pendientes',function(){
    return view('admin.pedidos.pedidos_pendientes.index');
})->name('pendientes')->middleware('auth');

Route::get('admin/pedidos_finalizados',function(){
    return view('admin.pedidos.pedidos_finalizados.index');
})->name('finalizados')->middleware('auth');

Route::resource('admin/pending_orders','PedidoController')->except(['show','create','destroy','edit']);

//Rutas Usuarios ***********************************************
Route::get('/admin/usuarios',function(){
    return view('admin.usuarios.index');
})->name('usuarios')->middleware('auth','can:admin-only');

Route::resource('admin/users','UserController')->except(['show','create','destroy','edit']);

//change password route

Route::put('/admin/newpass/{id}','UserController@newpass')->name('newpass');

//Ruta ventas

Route::get('/admin/ventas',function(){
    return view('admin.ventas.index');
})->name('ventas')->middleware('auth','can:admin-only');

//rutas charts

Route::get('/admin/chart_today','ChartController@today')->name('today');







