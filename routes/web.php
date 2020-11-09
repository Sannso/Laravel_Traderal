<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'App\Http\Controllers\PageController@inicio')->name('principal');

#Route::get('/producto', 'App\Http\Controllers\ProductosController@verProducto')->name('verProducto');
Route::get('/producto/{id}', 'App\Http\Controllers\ProductosController@verProducto')->name('verProductoId');

Route::get('/home/agregar', 'App\Http\Controllers\HomeController@agregarProducto')->name('agregarProducto');

Route::post('/producto/agregar/creando', 'App\Http\Controllers\HomeController@crearProducto')->name('crearProducto');

Route::get('/home/editar/{id}', 'App\Http\Controllers\HomeController@editarProducto')->name('editarProducto');
Route::post('/home/editar/{id}', 'App\Http\Controllers\HomeController@updateProducto')->name('updateProducto');


Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::delete('/home/{id}', 'App\Http\Controllers\HomeController@eliminarProducto')->name('eliminarProducto');



Route::get('/administracion', 'App\Http\Controllers\AdminController@inicio')->name('administracion');


