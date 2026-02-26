<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminOrderController;

// Bagian Pelanggan
Route::get('/', [OrderController::class, 'index'])->name('menu.index');
Route::post('/add-to-cart', [OrderController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', function () { return view('frontend.cart'); })->name('cart.view');
Route::post('/checkout', [OrderController::class, 'checkout'])->name('order.checkout');
Route::get('/payment/{id}', [OrderController::class, 'payment'])->name('order.payment');
Route::post('/order-complete/{id}', [OrderController::class, 'complete'])->name('order.complete');
Route::get('/success/{id}', [OrderController::class, 'success'])->name('order.success');

// Bagian Admin/Dapur
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminOrderController::class, 'index'])->name('admin.dashboard');
    Route::post('/order/{id}/update', [AdminOrderController::class, 'updateStatus'])->name('admin.order.update');
    Route::get('/report', [AdminOrderController::class, 'report'])->name('admin.report');
});