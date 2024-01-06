<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\OrderController;

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
    return view('index');
});
Route::prefix('produk')->name('produk.')->group(function() {
    Route::get('/data', [ProdukController::class, 'index'])->name('index');
    Route::get('/create', [ProdukController::class, 'create'])->name('create');
    Route::post('/store', [ProdukController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [ProdukController::class, 'edit'])->name('edit');
    Route::patch('/update/{id}', [ProdukController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [ProdukController::class, 'destroy'])->name('delete');
    Route::get('/api', [ProdukController::class, 'api'])->name('api');
});
Route::prefix('order')->name('order.')->group(function() {
    Route::get('/data', [OrderController::class, 'index'])->name('index');
    Route::get('/create', [OrderController::class, 'create'])->name('create');
    Route::post('/store', [OrderController::class, 'store'])->name('store');
    Route::get('/api-order', [OrderController::class, 'api'])->name('api');
});