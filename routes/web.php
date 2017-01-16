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

Route::get('/', function () {
    return view('auth/login');
});
Route::resource('almacen/categoria','ControladorCategoria');
Route::resource('almacen/articulo','ControladorArticulo');
Route::resource('ventas/cliente','ControladorCliente');
Route::resource('ventas/venta','ControladorVenta');
Route::resource('compras/proveedor','ControladorProveedor');
Route::resource('compras/ingreso','ControladorIngreso');
Route::resource('seguridad/usuario','ControladorUsuario');
Auth::routes();
Route::get('/home', 'HomeController@index');
Route::get('/{slug?}', 'HomeController@index');
