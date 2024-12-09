<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    /**
     * Muestra el formulario de login para el administrador.
     */
    public function showLoginForm()
    {
        return view('admin.login'); // Asegúrate de tener la vista en resources/views/admin/login.blade.php
    }

    /**
     * Procesa el inicio de sesión del administrador.
     */
    public function processLogin(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        // Verifica las credenciales en la base de datos
        $admin = \DB::table('admins')
            ->where('email', $email)
            ->where('password', $password)
            ->first();

        if ($admin) {
            // Guardar sesión o redirigir al dashboard
            session(['admin_logged_in' => true]);
            return redirect()->route('admin.dashboard');
        } else {
            return back()->withErrors(['login_error' => 'Credenciales incorrectas.']);
        }
    }

    /**
     * Cierra la sesión del administrador.
     */
    public function logout()
    {
        session()->forget('admin_logged_in');
        return redirect()->route('admin.login');
    }
}
