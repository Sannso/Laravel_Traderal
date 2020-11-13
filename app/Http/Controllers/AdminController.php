<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class AdminController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    
    }


    public function inicio(){
    	if(auth()->user()->id == 1){
	    	$products = Producto::groupBy('id', 'dueño', 'nombre', 'precio', 'descripcion', 'ruta', 'created_at', 'updated_at')
	    				->simplePaginate(6);

	    	return view('admin', compact('products'));
    	}
    	return back();
    }
}
