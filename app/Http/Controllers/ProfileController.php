<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    // Mostrar el formulario de edición del perfil para clientes
    public function editClient()
    {
        return view('client.settings');
    }

    // Mostrar el formulario de edición del perfil para administradores
    public function editAdmin()
    {
        return view('admin.settings');
    }

    // Actualizar los datos del perfil para clientes
    public function updateClient(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:15',
            'domicilio' => 'nullable|string|max:80',
        ]);

        auth()->user()->update($request->only('name', 'phone', 'domicilio'));

        return redirect()->back()->with('success', 'Perfil actualizado con éxito');
    }

    // Actualizar los datos del perfil para administradores
    public function updateAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:15',
        ]);

        auth()->user()->update($request->only('name', 'phone'));

        return redirect()->back()->with('success', 'Perfil de administrador actualizado con éxito');
    }

    // Eliminar el perfil del usuario (si es necesario)
    public function destroy()
    {
        auth()->user()->delete();

        return redirect('/')->with('success', 'Cuenta eliminada con éxito');
    }
}
