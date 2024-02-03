<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class RegisterController extends Controller {
    
    public function index() {   
        return view('auth.register');
    }

    public function store(Request $request) {

        // Modificar el request
        $request->request->add(['username' => Str::slug($request->username)]);

        // Validación
        $this->validate($request, [
            'name' => 'required|max:30',
            'username' => 'required|string|alpha_dash|min:3|max:20|unique:users,username',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|min:6',
        ]);

        // Crear registro
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password
        ]);

        // Autenticar el usuario
/*         auth()->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ]); */

        // Otra forma de autenticar
        auth()->attempt($request->only('email', 'password'));

        // Redireccionar al usuario
        return redirect()->route('posts.index', auth()->user()->username);
    }
}
