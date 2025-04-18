<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

use function Laravel\Prompts\password;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::orderBy('lastname', 'asc')
                ->paginate();


        return view ('pages.dashboard.admin.users', compact('users'));
    }

    public function checkUsername(Request $request)
    {
        $username = $request->input('username');
        $exists = User::where('username', $username)->exists();
        return response()->json(['exists' => $exists]);
    }

    public function create()
    {
        return view ('auth.register');
    }

    public function store(Request $request)
    {   
        $request->validate([
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|unique:users,email',
            'dni' => 'required|string|unique:users,dni',
            'date_birth' => 'required|date',
            'username' => 'required|string|unique:users,username',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser una cadena de texto.',
            'name.max' => 'El nombre no debe exceder los 255 caracteres.',
            
            'lastname.required' => 'El apellido es obligatorio.',
            'lastname.string' => 'El apellido debe ser una cadena de texto.',
            'lastname.max' => 'El apellido no debe exceder los 255 caracteres.',
            
            'address.required' => 'La dirección es obligatoria.',
            'address.string' => 'La dirección debe ser una cadena de texto.',
            'address.max' => 'La dirección no debe exceder los 255 caracteres.',
            
            'phone.required' => 'El teléfono es obligatorio.',
            'phone.string' => 'El teléfono debe ser una cadena de texto.',
            'phone.max' => 'El teléfono no debe exceder los 15 caracteres.',
            
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser válido.',
            'email.unique' => 'El correo electrónico ya está registrado.',
            
            'dni.required' => 'El DNI es obligatorio.',
            'dni.string' => 'El DNI debe ser una cadena de texto.',
            'dni.unique' => 'El DNI ya está registrado.',
            
            'date_birth.required' => 'La fecha de nacimiento es obligatoria.',
            'date_birth.date' => 'La fecha de nacimiento debe ser válida.',
            
            'username.required' => 'El nombre de usuario es obligatorio.',
            'username.string' => 'El nombre de usuario debe ser una cadena de texto.',
            'username.unique' => 'El nombre de usuario ya está en uso.',
            
            'password.required' => 'La contraseña es obligatoria.',
            'password.string' => 'La contraseña debe ser una cadena de texto.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ]);
        

        $user = new User();

        $user->name=$request->name;
        $user->lastname=$request->lastname;
        $user->address=$request->address;
        $user->phone=$request->phone;
        $user->email=$request->email;
        $user->dni=$request->dni;
        $user->date_birth=$request->date_birth;
        $user->username=$request->username;
        $user->password=$request->password;


        $user->save();

        $role = Role::where('name', 'student')->first();
        if($role){
            $user->roles()->attach($role);
        }
        session()->flash('success', 'User registered successfully!');
        return redirect()->intended($request->input('redirect', route('success')));
    }

    public function show($id)
    {
        $user = User::with('roles')->find($id);

        return view('pages.dashboard.admin.user', compact('user'));
    }

    public function edit($id)
    {
        $user = User::with('roles')->findOrFail($id);
        $roles = Role::all();

        return view('pages.dashboard.admin.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->name=$request->name;
        $user->lastname=$request->lastname;
        $user->address=$request->address;
        $user->phone=$request->phone;
        $user->email=$request->email;
        $user->dni=$request->dni;
        $user->date_birth=$request->date_birth;
        $user->username=$request->username;

        $user->save();
        
        $user->roles()->sync([$request->role]);
        
        return redirect("/users/$id");
    }

    public function destroy($id)
    {
        $user = User::find($id);

        $user->delete();

        return redirect('/users');
    }
}
