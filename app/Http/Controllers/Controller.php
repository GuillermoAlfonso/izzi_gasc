<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Perfil;
use App\Models\Producto;
use App\Models\Sesion;
use App\Models\Sucursal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;

use function PHPUnit\Framework\isEmpty;

class Controller extends BaseController
{
    public function create()
    {
        $categorias = Categoria::all(['id', 'nombre_categoria']);
        $sucursales = Sucursal::all(['id', 'nombre_sucursal']);
        return view('registrar-producto', compact('categorias', 'sucursales'));
    }

    public function createReportes()
    {
        return view('generar-reportes');
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

    public function generarReportes(Request $request)
    {
        $data = $request->validate([
            'fecha_inicio' => ['required'], /**/
            'fecha_fin' => ['required'],
        ]);

        try {
            $productos = Producto::where('estado', true)
                ->whereBetween('fecha_compra', [$data['fecha_inicio'], $data['fecha_fin']])
                ->orderBy('fecha_compra', 'ASC')
                ->get();

            if ($productos->count() < 1) {
                return back()->withErrors([
                    'error' => 'No hay productos en ese rango de fechas',
                ]);
            }

            $headers = array(
                "Content-type"        => "text/csv; charset=utf-8",
                "Content-Disposition" => "attachment; filename=Productos" . date('dmY') . ".csv",
                "Pragma"              => "no-cache",
                "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
                "Expires"             => "0"
            );

            $callback = function () use ($productos) {

                $delimiter = ',';

                $csv = fopen('php://output', 'w');

                $firstRow = array(
                    'ID',
                    'Nombre',
                    utf8_decode('Descripción'),
                    'Precio',
                    'Fecha compra',
                    'Estado',
                    'Comentarios',
                );

                fputcsv($csv, $firstRow, $delimiter);

                foreach ($productos as $val) {

                    $content = array(
                        $val->id,
                        utf8_decode($val->nombre),
                        utf8_decode($val->descripcion),
                        $val->precio,
                        $val->fecha_compra,
                        $val->estado,
                        utf8_decode($val->comentarios),
                    );

                    fputcsv($csv, $content, $delimiter);
                }

                fclose($csv);
            };

            return response()->stream($callback, 200, $headers);
        } catch (\Exception $e) {
            return redirect()
                ->route('generar-reportes')
                ->with('msg', 'Error al generar el reporte')
                ->with('type', 'error');
        }
    }

    public function descargaMasiva(Request $request)
    {

        $productos = Producto::all();
        $usuarios = User::all();
        $categorias = Categoria::all();
        $sucursales = Sucursal::all();
        $perfiles = Perfil::all();
        $sesiones = Sesion::all();

        try {

            $headers = array(
                "Content-Encoding"    => "utf-8",
                "Content-type"        => "text/csv; charset=utf-8",
                "Content-Disposition" => "attachment; filename=BaseDeDatos" . date('dmY') . ".csv",
                "Pragma"              => "no-cache",
                "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
                "Expires"             => "0"
            );

            $callback = function () use ($productos, $usuarios, $categorias, $sucursales, $perfiles, $sesiones) {

                $delimiter = ',';

                $csv = fopen('php://output', 'w');

                $cabecera_producto = array(utf8_decode('INFORMACIÓN TABLA PRODUCTO'));
                $cabecera_usuario = array(utf8_decode('INFORMACIÓN TABLA USUARIO'));
                $cabecera_categoria = array(utf8_decode('INFORMACIÓN TABLA CATEGORÍA'));
                $cabecera_sucursal = array(utf8_decode('INFORMACIÓN TABLA SUCURSAL'));
                $cabecera_perfil = array(utf8_decode('INFORMACIÓN TABLA PERFIL'));
                $cabecera_sesion = array(utf8_decode('INFORMACIÓN TABLA SESIÓN'));

                fputcsv($csv, $cabecera_producto, $delimiter);

                $firstRow = array(
                    'Id_producto',
                    'Nombre',
                    utf8_decode('Descripción'),
                    'Precio',
                    'Fecha compra',
                    'Estado',
                    'Comentarios',
                );

                fputcsv($csv, $firstRow, $delimiter);

                foreach ($productos as $val) {

                    $content = array(
                        $val->id,
                        utf8_decode($val->nombre),
                        utf8_decode($val->descripcion),
                        $val->precio,
                        $val->fecha_compra,
                        $val->estado,
                        utf8_decode($val->comentarios),
                    );

                    fputcsv($csv, $content, $delimiter);
                }

                fputcsv($csv, $cabecera_usuario, $delimiter);

                $firstRow = array(
                    'Id_usuario',
                    'Usuario',
                    utf8_decode('Contraseña'),
                    'Nombre',
                    'Apellido paterno',
                    'Apellido materno',
                    'Acceso',
                    'Perfil',
                );

                fputcsv($csv, $firstRow, $delimiter);

                foreach ($usuarios as $val) {

                    $content = array(
                        $val->id,
                        $val->usuario,
                        $val->contrasena,
                        utf8_decode($val->nombre),
                        utf8_decode($val->apellido_paterno),
                        utf8_decode($val->apellido_materno),
                        $val->acceso,
                        $val->perfil_id,
                    );

                    fputcsv($csv, $content, $delimiter);
                }

                fputcsv($csv, $cabecera_categoria, $delimiter);

                $firstRow = array(
                    'Id Categoria',
                    'Nombre Categoria',
                );

                fputcsv($csv, $firstRow, $delimiter);

                foreach ($categorias as $val) {

                    $content = array(
                        $val->id,
                        utf8_decode($val->nombre_categoria),
                    );

                    fputcsv($csv, $content, $delimiter);
                }

                fputcsv($csv, $cabecera_sucursal, $delimiter);

                $firstRow = array(
                    'Id Sucursal',
                    'Nombre Sucursal',
                );

                fputcsv($csv, $firstRow, $delimiter);

                foreach ($sucursales as $val) {

                    $content = array(
                        $val->id,
                        utf8_decode($val->nombre_sucursal),
                    );

                    fputcsv($csv, $content, $delimiter);
                }

                fputcsv($csv, $cabecera_perfil, $delimiter);

                $firstRow = array(
                    'Id Perfil',
                    'Nombre perfil',
                );

                fputcsv($csv, $firstRow, $delimiter);

                foreach ($perfiles as $val) {

                    $content = array(
                        $val->id,
                        utf8_decode($val->nombre_perfil),
                    );

                    fputcsv($csv, $content, $delimiter);
                }

                fputcsv($csv, $cabecera_sesion, $delimiter);

                $firstRow = array(
                    utf8_decode('Id Sesión'),
                    utf8_decode('Fecha sesión'),
                    'ID usuario'
                );

                fputcsv($csv, $firstRow, $delimiter);

                foreach ($sesiones as $val) {

                    $content = array(
                        $val->id,
                        $val->fecha_sesion,
                        $val->usuario_id,
                    );

                    fputcsv($csv, $content, $delimiter);
                }

                fclose($csv);
            };

            return response()->stream($callback, 200, $headers);
        } catch (\Exception $e) {
            return back()->withErrors([
                'error' => 'Error al generar los reportes',
            ]);
        }
    }
}
