<?php

namespace App\Http\Controllers;

use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class ProfileController extends Controller
{

    //Metodo para mostrar el perfil del usuario
    public function edit()
    {
        $user = auth()->user();
        return view('pages.dashboard.profile', compact('user'));
    }

    //Metodo para actualizar el perfil del usuario
    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'lastname' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        $user->update([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'address' => $request->address,
            'phone' => $request->phone,
            'username' => $request->username,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        
        if ($request->hasFile('avatar')) {
            
           

            if ($user->avatar && Storage::disk('public')->exists('avatars/' . $user->avatar->avatar)) {
                Storage::disk('public')->delete('avatars/' . $user->avatar->avatar);
                
            } 
            
           
            $upload = $request->file('avatar');
            $image = Image::read($upload)
                ->scale(height: 300);

            $avatarName = Str::random() . '.' . $upload->getClientOriginalExtension();
           
            Storage::disk('public')->put(
                'avatars/' . $avatarName,
                $image->encodeByExtension($upload->getClientOriginalExtension(), quality: 70)
            );
        
            // Guarda la referencia en la base de datos
            $user->avatar()->updateOrCreate(
                ['user_id' => $user->id],
                ['avatar' => $avatarName]
                );
            }

        return redirect()->back()->with('success', 'Perfil actualizado correctamente');
    }
}
