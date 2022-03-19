<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Sesion;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Stmt\TryCatch;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'usuario';
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'usuario' => ['required', 'max:12'],
            'contrasena' => ['required', 'max:15', 'min:11'],
        ]);

        $attempt = Auth::attempt([
            'usuario' => $request->usuario,
            'contrasena' => $request->contrasena,
            'acceso' => 1
        ]);

        if ($attempt) {
            try {
                Sesion::create([
                    'fecha_sesion' => now(),
                    'usuario_id' => Auth::user()->id,
                ]);

                $request->session()->regenerate();
                
                Session::put('usuario', Auth::user()->usuario);
                Session::put('perfil', Auth::user()->perfil_id);

                return redirect(RouteServiceProvider::HOME);
                
            } catch (\Throwable $th) {
                return back()->withErrors([
                    'error' => 'Error al iniciar sesión',
                ]);
            }
        } else {
            return back()->withErrors([
                'error' => 'Nombre de usuario y/o contraseña incorrectos',
            ]);
        }
    }


    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
