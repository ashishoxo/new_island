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

Route::middleware(['auth:admin'])->group(function () {
    
    Route::get('/admin/dashboard', function(){
        echo 'Admin login success. work in progress!!
            <a class="dropdown-item" href="{{ route(\'logout\') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById(\'logout-form\').submit();">
                                    {{ __(\'Logout\') }}
                                </a>

                                <form id="logout-form" action="{{ route(\'logout\') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
        ';
    })->name('admin.dashboard');
});
