<?php

namespace App\Http\Controllers;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Producto;
use App\Models\DetallePedido;
use App\Models\Cubierta;
use App\Models\Relleno;
use App\Models\Sabor;
use App\Models\Tamano;
use App\Models\Topping;
use App\Models\Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    // Mostrar el formulario de creación de pedido
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

    // Almacenar un nuevo pedido y sus detalles
    public function store(Request $request)
{
    // Validación de los datos del formulario
    $validated = $request->validate([
        'ID_usuario' => 'required|integer',
        'fecha_pedido' => 'required|date',
        'fecha_entrega' => 'required|date',
        'producto' => 'required|array',
        'producto.*.ID_producto' => 'required|integer',
        'producto.*.cantidad' => 'required|integer|min:1',
        'producto.*.ID_size' => 'required|integer',
        'producto.*.ID_sabor' => 'required|integer',
        'producto.*.ID_top' => 'nullable|integer',
        'producto.*.ID_relleno' => 'nullable|integer',
        'producto.*.ID_cubierta' => 'nullable|integer',
    ]);

    // Convertir los productos a JSON
    $productosJson = json_encode($request->producto);

    // Llamada al procedimiento almacenado, añadiendo fecha_pedido
    DB::select('CALL sp_crear_pedido(?, ?, ?, ?)', [
        $request->ID_usuario,
        $request->fecha_pedido,  // Añadido: fecha del pedido
        $request->fecha_entrega,
        $productosJson
    ]);

    // Redirigir o devolver mensaje de éxito
    return redirect()->route('client.orders.index')->with('success', 'Pedido creado exitosamente');
}

}
