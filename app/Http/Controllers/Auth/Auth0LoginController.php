<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Auth0\Laravel\Facade\Auth0;

class Auth0LoginController extends Controller
{
    
    public function redirectToAuth0()
    {
        return Auth0::login(null, null, ['scope' => 'openid profile email'], 'code');
    }

    
    public function handleCallback(Request $request)
    {
        $auth0User = Auth0::getUser();

        if (!$auth0User) {
            return redirect('/login')->withErrors('Error al autenticar con Auth0');
        }

    
        $user = User::firstOrCreate(
            ['email' => $auth0User->email],
            [
                'name' => $auth0User->name ?? 'Sin Nombre',
            ]
        );

        Auth::login($user);

        return redirect()->intended('/');
    }
}