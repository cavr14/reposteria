@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card shadow-sm rounded-lg">
            <div class="card-header text-center">
                <h2>Crear Pedido</h2>
            </div>
            <div class="card-body">
            <form action="{{ route('client.orders.store') }}" method="POST">
                    @csrf
                    <!-- Campo para seleccionar el usuario -->
                    <div class="form-group mb-3">
                        <label for="ID_usuario" class="form-label">Usuario</label>
                        <select name="ID_usuario" id="ID_usuario" class="form-control" required>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                            @endforeach
                        </select>
                    </div><br>

                    <div class="form-group mb-3">
                    <label for="fecha_pedido" class="form-label">Fecha de Pedido</label>
                    <input type="date" name="fecha_pedido" id="fecha_pedido" class="form-control" required>
                    </div>

                    <!-- Campo para seleccionar la fecha de entrega -->
                    <div class="form-group mb-3">
                        <label for="fecha_entrega" class="form-label">Fecha de Entrega</label>
                        <input type="date" name="fecha_entrega" id="fecha_entrega" class="form-control" required>
                    </div>

                   <!-- Campos para agregar productos al pedido -->
                <div class="form-group mb-3">
                    <label for="productos" class="form-label">Producto</label>
                    <div id="productos">
                        <div class="producto mb-2">
                            <!-- Select para elegir tipo de producto con descripción -->
                            <select name="productos[0][ID_producto]" class="form-control" required>
                                <option value="">Seleccionar Producto</option>
                                @foreach($productos as $producto)
                                    <option value="{{ $producto->ID }}">
                                        {{ $producto->tipo_producto }} - {{ $producto->descripcion }}
                                    </option>
                                @endforeach
                            </select>

                            <!-- Campo de texto para cantidad (piezas) -->
                            <input type="number" name="productos[0][cantidad]" class="form-control mt-1" placeholder="Cantidad (piezas)" max="4000" required>

                            <!-- Select para elegir tamaño con precio -->
                            <select name="productos[0][ID_size]" class="form-control mt-2" required>
                                <option value="">Seleccionar Tamaño</option>
                                @foreach($tamanos as $tamano)
                                    <option value="{{ $tamano->ID_size }}">
                                        {{ $tamano->nombreT }} - ${{ $tamano->precio_size }}
                                    </option>
                                @endforeach
                            </select>

                            <!-- Select para elegir sabor -->
                            <select name="productos[0][ID_sabor]" class="form-control mt-2" required>
                                <option value="">Seleccionar Sabor</option>
                                @foreach($sabores as $sabor)
                                    <option value="{{ $sabor->ID_Sabor }}">{{ $sabor->nombre_s }}</option>
                                @endforeach
                            </select>

                            <!-- Select para elegir topping con precio -->
                            <select name="productos[0][ID_top]" class="form-control mt-2">
                                <option value="">Seleccionar Topping</option>
                                @foreach($toppings as $topping)
                                    <option value="{{ $topping->ID_top }}">
                                        {{ $topping->nombre_top }} - ${{ $topping->precio_top }}
                                    </option>
                                @endforeach
                            </select>

                            <!-- Select para elegir relleno con precio -->
                            <select name="productos[0][ID_relleno]" class="form-control mt-2">
                                <option value="">Seleccionar Relleno</option>
                                @foreach($rellenos as $relleno)
                                    <option value="{{ $relleno->ID_relleno }}">
                                        {{ $relleno->nombre_r }} - ${{ $relleno->precio_relleno }}
                                    </option>
                                @endforeach
                            </select>

                            <!-- Select para elegir cubierta con precio -->
                            <select name="productos[0][ID_cubierta]" class="form-control mt-2">
                                <option value="">Seleccionar Cubierta</option>
                                @foreach($cubiertas as $cubierta)
                                    <option value="{{ $cubierta->ID_cubierta }}">
                                        {{ $cubierta->nombre_c }} - ${{ $cubierta->precio_cub }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>


                   
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-lg">Crear Pedido</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .container {
            max-width: 800px;
            margin-top: 30px;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #f8f9fa;
            font-size: 1.5rem;
            font-weight: bold;
        }
        .form-group label {
            font-weight: 600;
        }
        .form-control {
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.25rem rgba(38, 143, 255, 0.5);
        }
        button[type="submit"] {
            background-color: #007bff;
            color: white;
            border-radius: 30px;
            font-size: 1.1rem;
            padding: 12px 30px;
            transition: background-color 0.3s ease;
        }
        button[type="submit"]:hover {
            background-color: #0056b3;
        }
        .producto select, .producto input {
            margin-bottom: 10px;
        }
    </style>
@endsection
