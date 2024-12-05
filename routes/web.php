<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminAuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::put('/admin/update-status/{id}', [AdminDashboardController::class, 'updateStatus'])->name('admin.update-status');



Route::post('/admin/pedidos/{id}/status', function ($id) {
    $status = request('status');
    DB::table('pedidos')->where('id', $id)->update(['status' => $status]);
    return redirect()->back();
})->name('admin.pedidos.status');






Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'processLogin'])->name('admin.processLogin');
Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
