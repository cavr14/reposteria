@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Bienvenido, {{ auth()->user()->name }}!</h1>
        <p>Este es tu panel de control.</p>
    </div>
@endsection
