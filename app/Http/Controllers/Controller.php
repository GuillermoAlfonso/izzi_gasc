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
        $opcion = $request->boton;

        return view('editar-producto', compact('opcion'));
    }

    public function store(Request $request)
    {
        /* $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
       ]);*/

        $producto = new Producto([
            'nombre' => $request->nombre_producto,
            'descripcion' => $request->descripcion,
            'categoria_id' => $request->categoria_id,
            'sucursal_id' => $request->sucursal_id,
            'precio' => $request->precio,
            'fecha_compra' => $request->fecha_compra,
        ]);

        $bandera = $producto->save();

        if ($bandera) {
            return redirect(RouteServiceProvider::HOME);
        }

        return back()->withErrors([
            'error' => 'Error al insertar producto',
        ]);
    }
}
