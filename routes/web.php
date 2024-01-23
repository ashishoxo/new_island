<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/cart', function () {
    return view('cart');
})->name('cart');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/admin/login', [App\Http\Controllers\AdminAuth\LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [App\Http\Controllers\AdminAuth\LoginController::class, 'login']);

Route::middleware(['auth:web'])->group(function () {
    // Routes accessible to regular users
});

Route::middleware(['auth:admin'])->prefix('admin/')->group(function () {
    
    Route::get('dashboard', function(){
        return view('admin/dashboard');
    })->name('admin.dashboard');

    Route::resources([
        'categories' => App\Http\Controllers\CategoryController::class,
        'products' => App\Http\Controllers\ProductController::class
    ]);
});
