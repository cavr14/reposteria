<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    // Mostrar el formulario de edición del perfil
    public function edit()
    {
        return view('profile.edit');
    }

    // Actualizar los datos del perfil
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . auth()->id(),
        ]);

        auth()->user()->update($request->only('name', 'email'));

        return redirect()->route('profile.edit')->with('success', 'Perfil actualizado con éxito');
    }

    // Eliminar el perfil del usuario (si es necesario)
    public function destroy()
    {
        auth()->user()->delete();

        return redirect('/')->with('success', 'Cuenta eliminada con éxito');
    }
}
