<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class PageController extends Controller
{
    public function inicio(Request $request){
    	$name = $request->get('name');
    	$bio  = $request->get('desc');

    	$products = Producto::orderBy('id', 'ASC')
    				->name($name)
    				->bio($bio)
    				->having('activo', '=', 'si')
    				->simplePaginate(6);

    	return view('welcome', compact('products'));
    }
}
