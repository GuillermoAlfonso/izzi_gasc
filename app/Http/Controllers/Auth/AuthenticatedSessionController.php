<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $attempt = Auth::attempt([
            'usuario' => $request->usuario,            
            'contrasena' => $request->contrasena,
            'acceso' => 1
        ]);

        if ($attempt) {
            $request->session()->regenerate();

            return redirect(RouteServiceProvider::HOME);
        }
        
        return back()->withErrors([
            'error' => 'Nombre de usuario y/o contraseña incorrectos',
        ]);
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
