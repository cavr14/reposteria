<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Providers\RouteServiceProvider;

class RegisteredUserController extends Controller
{
    // Método para mostrar el formulario de registro
    public function create()
    {
        return view('auth.register');  // Retorna la vista de registro
    }

    // Método para registrar al usuario (método POST)
    public function store(Request $request)
    {
        // Validación de los datos del formulario
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'name' => ['required', 'string', 'max:255'],
        ]);

        // Crear el nuevo usuario en la base de datos
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Iniciar sesión automáticamente después de registrarse (opcional)
        auth()->login($user);

        // Redirigir al usuario después de registrarse a la página de éxito
        return redirect()->route('register.success');
    }
}
