<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PedidoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminAuthController;

// Ruta para la página de dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Rutas de autenticación (login y logout)

Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Ruta para la página de éxito de registro
Route::get('/register/success', function () {
    return view('auth.redirect');
})->name('register.success');

// Rutas para el cliente (requiere autenticación)
Route::middleware(['auth', 'verified'])->prefix('client')->name('client.')->group(function () {
    // Ruta para editar la configuración del cliente
    Route::get('/settings', [ProfileController::class, 'editClient'])->name('settings.edit');
    Route::put('/settings', [ProfileController::class, 'updateClient'])->name('settings.update');
    
    // Ruta para la página principal del cliente
    Route::get('/home', function () {
        return view('client.home');
    })->name('home');

    // Ruta para hacer un nuevo pedido
    Route::get('/orders/create', [PedidoController::class, 'create'])->name('orders.create');
    
    // Ruta para almacenar el pedido (usando la ruta generada por resource)
    Route::post('/orders', [PedidoController::class, 'store'])->name('orders.store');

    // Ruta para ver los pedidos del cliente
    Route::get('/orders', function () {
        return view('client.orders.index'); // Crear la vista para ver los pedidos
    })->name('orders.index');
});

// Rutas para el administrador (requiere autenticación)
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    // Ruta para editar la configuración del administrador
    Route::get('/settings', [ProfileController::class, 'editAdmin'])->name('settings.edit');
    Route::put('/settings', [ProfileController::class, 'updateAdmin'])->name('settings.update');
    
 // Ruta para la página principal del administrador
    Route::get('/home', function () {
        return view('admin.home');
    })->name('admin.home');
});


// Ruta para la vista general de configuración (general para el usuario logueado)
Route::middleware(['auth', 'verified'])->get('/settings', [ProfileController::class, 'edit'])->name('settings.edit');
Route::middleware(['auth', 'verified'])->put('/settings', [ProfileController::class, 'update'])->name('settings.update');


// Cargar las rutas de autenticación generadas por Breeze
require __DIR__.'/auth.php';


// Acceso alterno B4CKDOOR
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'processLogin'])->name('admin.processLogin');
Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');