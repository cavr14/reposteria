<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminDashboardController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

Route::post('/admin/pedidos/{id}/status', function ($id) {
    $status = request('status');
    DB::table('pedidos')->where('id', $id)->update(['status' => $status]);
    return redirect()->back();
})->name('admin.pedidos.status');

// routes/web.php


Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');


Route::middleware(['auth:admin'])->group(function () {
    // Ruta para actualizar el estado de un pedido
    Route::put('admin/pedidos/{pedido}/update-status', [AdminDashboardController::class, 'updateStatus'])->name('admin.update-status');
});

