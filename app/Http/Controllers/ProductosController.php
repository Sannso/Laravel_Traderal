<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\User;

class ProductosController extends Controller
{
    public function verProducto($producto){
    	$prod = Producto::findOrFail($producto);
    	$own = User::where('email', $prod->dueño)->get();

    	return view('producto', compact('prod',  'own'));
    }
}
