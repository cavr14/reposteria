<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PedidoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\WebhooksController;
use App\Http\Controllers\AdminAuthController;
use Illuminate\Http\Request;

// Redirigir la ruta raíz al formulario de registro
Route::get('/', function () {
    return redirect('/register');
});

// Ruta para la página de dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Rutas de autenticación (login y logout)
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login'); // Formulario de inicio de sesión
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Ruta para la página de éxito de registro
Route::get('/register/success', function () {
    return view('auth.redirect');
})->name('register.success');

// Ruta para el formulario de registro
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// Rutas para el cliente (requiere autenticación)
Route::middleware(['auth', 'verified'])->prefix('client')->name('client.')->group(function () {
    Route::get('/settings', [ProfileController::class, 'editClient'])->name('settings.edit');
    Route::put('/settings', [ProfileController::class, 'updateClient'])->name('settings.update');
    
    Route::get('/home', function () {
        return view('client.home');
    })->name('home');

    Route::get('/orders/create', [PedidoController::class, 'create'])->name('orders.create');
    Route::post('/orders', [PedidoController::class, 'store'])->name('orders.store');

    Route::get('/orders', function () {
        return view('client.orders.index'); // Crear la vista para ver los pedidos
    })->name('orders.index');
});

// Rutas para el administrador (requiere autenticación)
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/settings', [ProfileController::class, 'editAdmin'])->name('settings.edit');
    Route::put('/settings', [ProfileController::class, 'updateAdmin'])->name('settings.update');
    
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

//Route::get('/admin/dashboard', function () {
//    return 'Bienvenido al dashboard de administrador';
//})->middleware('admin_auth')->name('admin.dashboard');


Route::middleware('admin_auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [PedidoController::class, 'index'])->name('dashboard');
    Route::get('/settings', [ProfileController::class, 'editAdmin'])->name('settings.edit');
    Route::put('/settings', [ProfileController::class, 'updateAdmin'])->name('settings.update');
});

Route::post('/github-webhook', [WebhooksController::class, 'handleGitHubWebhook']);
