@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="mb-4">Pedidos Pendientes</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID Pedido</th>
                <th>Cliente</th>
                <th>Fecha de Entrega</th>
                <th>Productos</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pedidos as $pedido)
                <td>{{ $pedido->cliente->nombre }}</td>
                    @foreach ($pedido->detallePedidos as $detalle)
                        <td>{{ $detalle->producto->nombre }}</td>
                        <td>{{ $pedido->cliente->nombre }}</td>
                        <td>{{ $pedido->fecha_entrega }}</td>
                    <td>
                        <ul>
                            @foreach ($pedido->detallePedidos as $detalle)
                                <li>
                                    {{ $detalle->producto->nombre }} 
                                    ({{ $detalle->cantidad }}x) 
                                    - {{ $detalle->tamanoT->nombre }} 
                                    @if ($detalle->sabor) con sabor {{ $detalle->sabor->nombre }} @endif
                                    @if ($detalle->cubierta) y cubierta {{ $detalle->cubierta->nombre_c }} @endif
                                    @if ($detalle->relleno) con relleno {{ $detalle->relleno->nombre_r }} @endif
                                    @if ($detalle->topping) y topping {{ $detalle->topping->nombre_t }} @endif
                                </li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        <a href="#" class="btn btn-primary">Marcar como realizado</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
