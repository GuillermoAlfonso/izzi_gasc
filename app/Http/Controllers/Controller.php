<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Sucursal;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;



class Controller extends BaseController
{
    public function create()
    {
        $categorias = Categoria::all(['id', 'nombre_categoria']);
        $sucursales = Sucursal::all(['id', 'nombre_sucursal']);
        return view('registrar-producto', compact('categorias', 'sucursales'));
    }

    public function showProducts()
    {
        $productos = Producto::all();

        return view('mostrar-productos', compact('productos'));
    }

    public function destroy(Request $request)
    {
        $id = $request->boton;
        $producto = Producto::find($id);
        $bandera = $producto->delete();

        if ($bandera) {
            $productos = Producto::all();
            return view('mostrar-productos', compact('productos'));
        }

        return back()->withErrors([
            'error' => 'Error al eliminar producto',
        ]);
    }

    public function edit(Request $request)
    {
        $id = $request->boton;
        $producto = Producto::find($id);

        if (!empty($producto)) {
            return view('editar-producto', compact('producto'));
        }

        return back()->withErrors([
            'error' => 'Error al buscar producto',
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_producto' => ['required', 'string', 'max:30'],
            'descripcion' => ['required', 'string', 'max:100'],
            'categoria_id' => ['required'],
            'sucursal_id' => ['required'],
            'precio' => ['required', 'numeric', 'digits_between:1,5'],
            'fecha_compra' => ['required'],            
        ]);

        $producto = new Producto([
            'nombre' => $request->nombre_producto,
            'descripcion' => $request->descripcion,
            'categoria_id' => $request->categoria_id,
            'sucursal_id' => $request->sucursal_id,
            'precio' => $request->precio,
            'fecha_compra' => $request->fecha_compra,
            'estado' => 1,            
        ]);

        $bandera = $producto->save();

        if ($bandera) {
            return redirect(RouteServiceProvider::HOME);
        }

        return back()->withErrors([
            'error' => 'Error al insertar producto',
        ]);
    }

    public function editForm(Request $request)
    {
        
        $request->validate([
            'comentarios' => ['required', 'string', 'max:100'], /**/ 
            'radio' => ['required'],
        ]);

        $id = $request->id_producto;
        $producto = Producto::find($id);

        if (!empty($producto)) {

            $producto->comentarios = $request->comentarios;
            $producto->estado = $request->radio;

            $bandera = $producto->save();

            if ($bandera) {                                
                $productos = Producto::all();
                return view('mostrar-productos', compact('productos'));
            }
        }
        
        return back()->withErrors([
            'error' => 'Error al actualizar producto',
        ]);
        
    }
}
