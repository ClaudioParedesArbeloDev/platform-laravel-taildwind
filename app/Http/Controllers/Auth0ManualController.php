<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Auth0ManualController extends Controller
{
    public function login()
    {
        $query = http_build_query([
            'client_id' => env('AUTH0_CLIENT_ID'),
            'redirect_uri' => env('AUTH0_REDIRECT_URI'),
            'response_type' => 'code',
            'scope' => 'openid profile email',
            'audience' => env('AUTH0_AUDIENCE'),
        ]);

        return redirect("https://" . env('AUTH0_DOMAIN') . "/authorize?" . $query);
    }

    public function callback(Request $request)
    {
        $code = $request->get('code');

        if (!$code) {
            \Log::error('Auth0 callback sin código', ['request' => $request->all()]);
            return redirect('/login')->with('error', 'No se recibió código de autorización.');
        }

        $tokenResponse = Http::asForm()->post("https://" . env('AUTH0_DOMAIN') . "/oauth/token", [
            'grant_type' => 'authorization_code',
            'client_id' => env('AUTH0_CLIENT_ID'),
            'client_secret' => env('AUTH0_CLIENT_SECRET'),
            'code' => $code,
            'redirect_uri' => env('AUTH0_REDIRECT_URI'),
        ]);

        if (!$tokenResponse->successful()) {
            \Log::error('Error al obtener token de Auth0', ['response' => $tokenResponse->json()]);
            return redirect('/login')->with('error', 'Error al obtener token de acceso.');
        }

        $accessToken = $tokenResponse->json()['access_token'];

        $userInfo = Http::withToken($accessToken)
            ->get("https://" . env('AUTH0_DOMAIN') . "/userinfo")
            ->json();

        // Crear o actualizar usuario local
        $user = User::updateOrCreate(
            ['email' => $userInfo['email']],
            [
                'name' => $userInfo['name'] ?? $userInfo['nickname'],
                'username' => $userInfo['nickname'] ?? null,
                'picture' => $userInfo['picture'] ?? null,
            ]
        );

        Auth::login($user);

        return redirect('/dashboard'); // o a donde quieras redirigir
    }
}
