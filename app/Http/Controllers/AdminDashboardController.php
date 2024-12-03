<?php

// app/Http/Controllers/AdminDashboardController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;


class AdminDashboardController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::where('status', 'pendiente')->get();
        return view('auth.dashboard', compact('pedidos'));
    }

    // Método para actualizar el estado del pedido
    public function updateStatus(Request $request, $id)
    {
        // Buscar el pedido por ID
        $pedido = Pedido::findOrFail($id);

        // Validar el nuevo estado
        $request->validate([
            'status' => 'required|in:pendiente,en_proceso,finalizado',
        ]);

        // Actualizar el estado del pedido
        $pedido->status = $request->status;
        $pedido->save();

        // Redirigir de vuelta al dashboard
        return redirect()->route('admin.dashboard')->with('success', 'Estado del pedido actualizado');
    }
}
