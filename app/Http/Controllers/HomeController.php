<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('auth');
    }


    public function index(){
        $allprod = Producto::where('dueño', auth()->user()->email)->simplePaginate(3);
        return view('home', compact('allprod'));
    }



    public function agregarProducto(){
        return view('crearproducto');
    }


    public function crearProducto(Request $request){
        $request->validate(['name' => 'required',
                        'descripcion' => 'required',
                        'precio' => 'required']);

        $archivo = $request->file('image');
        if($archivo){
            $imagen = $archivo->getClientOriginalName();
            $archivo->move('images', $imagen);
        }
        else{
            $imagen = "default.png";
        }

        $newproducto = new Producto;

        $newproducto->nombre = $request->name;
        $newproducto->descripcion = $request->descripcion;
        $newproducto->dueño = auth()->user()->email;
        $newproducto->precio = $request->precio;
        $newproducto->ruta = $imagen;

        $newproducto->save();

        return back()->with('successcreate', 'El producto ha sido agregada con exito!');
    }

    public function editarProducto($producto){
        $miproducto = Producto::findOrFail($producto);
        return view('editarProducto', compact('miproducto'));
    }    

    public function updateProducto(Request $request, $id){
        $prod = Producto::findOrFail($id);
        $prod->nombre = $request->name;
        $prod->descripcion = $request->descripcion;
        $prod->precio = $request->precio;

        $archivo = $request->file('image');
        if($archivo){
            $imagen = $archivo->getClientOriginalName();
            $archivo->move('images', $imagen);
            $prod->ruta = $imagen;
        }
        else{
            $imagen = "default.png";
        }

        $prod->save();
        return back()->with('successedit', 'El producto ha sido editado con exito!');
    }

    public function eliminarProducto($producto){
        $miproducto = Producto::findOrFail($producto);
        $miproducto->delete();

        return back()->with('successdelete', 'El producto ha sido eliminado con exito!');
    }
}
