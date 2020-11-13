<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Historial;

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
        $allprod = Producto::where('dueño', auth()->user()->email)
                    ->where('activo', 'si')
                    ->simplePaginate(3);

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

        # Creacion de registro en Producto
        $newproducto = new Producto;

        $newproducto->nombre = $request->name;
        $newproducto->descripcion = $request->descripcion;
        $newproducto->dueño = auth()->user()->email;
        $newproducto->precio = $request->precio;
        $newproducto->ruta = $imagen;
        $newproducto->activo = 'si';

        $newproducto->save();

        # Creacion de registro en Historial
        $newhist = new Historial;
        $idprod = Producto::where('dueño', auth()->user()->email)
                            ->get()
                            ->last();

        $newhist->id_producto = strval($idprod->id);
        $newhist->producto = $request->name;
        $newhist->dueño = auth()->user()->email;
        $newhist->precio = $request->precio;
        $newhist->accion = 'Se creo el producto';

        $newhist->save();

        return back()->with('successcreate', 'El producto ha sido agregada con exito!');
    }

    public function editarProducto($producto){
        $miproducto = Producto::findOrFail($producto);
        return view('editarProducto', compact('miproducto'));
    }    

    public function updateProducto(Request $request, $id){
        $prod = Producto::findOrFail($id);
        $idp = $prod->id;
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

        #Update historial
        $newhist = new Historial;

        $newhist->id_producto = strval($idp);
        $newhist->producto = $request->name;
        $newhist->dueño = auth()->user()->email;
        $newhist->precio = $request->precio;
        $newhist->accion = 'Se modifico el producto';

        $newhist->save();
        return back()->with('successedit', 'El producto ha sido editado con exito!');
    }

    public function eliminarProducto($producto){
        $miproducto = Producto::findOrFail($producto);
        #$miproducto->delete();
        $miproducto->activo = 'no';
        $miproducto->save();

        #Update historial
        $newhist = new Historial;

        $newhist->id_producto = strval($miproducto->id);
        $newhist->producto = $miproducto->nombre;
        $newhist->dueño = auth()->user()->email;
        $newhist->precio = $miproducto->precio;
        $newhist->accion = 'Se elimino el producto';

        $newhist->save();

        return back()->with('successdelete', 'El producto ha sido eliminado con exito!');
    }

    public function historial(){
        $products = Historial::where('dueño', auth()->user()->email)->simplePaginate(4);
        if(auth()->user()->id == 1){
            $products = Historial::groupBy('id', 'id_producto', 'producto', 'dueño', 'precio', 'accion', 'created_at', 'updated_at')
                        ->simplePaginate(6);
        }
        return view('historial', compact('products'));
    }
}
