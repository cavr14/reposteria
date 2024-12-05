<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminAuthController extends Controller
{
    // Mostrar el formulario de login
    public function showLoginForm()
    {
        return view('auth.admin-login');
    }

    // Procesar el login
    public function processLogin(Request $request)
    {
        // Obtener las credenciales del formulario
        $email = $request->input('email');
        $password = $request->input('password');

        // Verificar en la base de datos
        $admin = DB::table('admins')
            ->where('email', $email)
            ->where('password', $password) // Comparación directa
            ->first();

        if ($admin) {
            // Credenciales correctas, redirigir al dashboard
            return redirect()->route('admin.dashboard')->with('success', '¡Bienvenido, ' . $admin->name . '!');
        } else {
            // Credenciales incorrectas
            return back()->with('error', 'Las credenciales son incorrectas.');
        }
    }

    // Mostrar el dashboard
    public function dashboard()
    {
        return view('auth.dashboard');
    }
}
