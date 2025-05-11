<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Auth0\Laravel\Facade\Auth0;

class Auth0LoginController extends Controller
{
    /**
     * Redirige a Auth0 para login.
     */
    public function redirectToAuth0()
    {
        return Auth0::login(null, null, ['scope' => 'openid profile email'], 'code');
    }

    /**
     * Maneja el callback de Auth0.
     */
    public function handleCallback(Request $request)
    {
        $auth0User = Auth0::getUser();

        if (!$auth0User) {
            return redirect('/login')->withErrors('Error al autenticar con Auth0');
        }

        // Buscar o crear usuario local
        $user = User::firstOrCreate(
            ['email' => $auth0User->email],
            [
                'name' => $auth0User->name ?? 'Sin Nombre',
                // Podés guardar el sub o auth0_id si querés
                // 'auth0_id' => $auth0User->sub,
            ]
        );

        Auth::login($user);

        return redirect()->intended('/');
    }
}