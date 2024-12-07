<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Producto;
use App\Models\Tamano;
use App\Models\Topping;
use App\Models\Cubierta;
use App\Models\Relleno;
use App\Models\User;
use App\Models\Pedido;
use App\Models\DetallePedido;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function create()
    {
        // Obtener los productos, cubiertas, tamaños, sabores, etc.
        $productos = Producto::all();
        $cubiertas = Cubierta::all();
        $rellenos = Relleno::all();
        $sabores = Sabor::all();
        $tamanos = Tamano::all();
        $toppings = Topping::all();
        $users = User::all();  // Trae todos los usuarios

        return view('client.orders.create', compact('productos', 'cubiertas', 'rellenos', 'sabores', 'tamanos', 'toppings', 'users'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'ID_usuario' => 'required|exists:users,id',
            'fecha_entrega' => 'required|date',
            'productos' => 'required|array|min:1',
            'productos.*.ID_producto' => 'required|exists:productos,ID',
            'productos.*.cantidad' => 'required|integer|min:1',
            'productos.*.ID_sabor' => 'required|exists:sabores,ID_Sabor',
            'productos.*.ID_size' => 'required|exists:tamanos,ID_size',
            'productos.*.ID_top' => 'nullable|exists:topping,ID_top',
            'productos.*.ID_cubierta' => 'nullable|exists:cubierta,ID_cubierta',
            'productos.*.ID_relleno' => 'nullable|exists:relleno,ID_relleno',
        ]);

        try {
            // Preparar los datos de productos como JSON
            $productos = $request->input('productos');

            // Llamar al procedimiento almacenado para crear el pedido
            DB::statement('CALL sp_crear_pedido(?, ?, ?)', [
                $request->ID_usuario,
                $request->fecha_entrega,
                json_encode($productos)
            ]);

            return redirect()->route('client.home')->with('success', 'Pedido creado exitosamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al crear el pedido: ' . $e->getMessage())->withInput();
        }
    }
}
