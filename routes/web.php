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

Route::get('/',  [App\Http\Controllers\HomeController::class, 'welcome'])->name('welcome');
// Route::get('/cart', function () {
//     return view('cart');
// })->name('cart');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/product/{category_id}', [App\Http\Controllers\HomeController::class, 'products'])->name('home.products');
Route::get('/product-detail/{product_id}', [App\Http\Controllers\HomeController::class, 'productDetails'])->name('home.product.details');

Route::get('/admin/login', [App\Http\Controllers\AdminAuth\LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [App\Http\Controllers\AdminAuth\LoginController::class, 'login']);

Route::middleware(['auth:web'])->group(function () {
    // Routes accessible to regular users
});

Route::resources([
    'cart' => App\Http\Controllers\CartItemController::class
]);

Route::post('/cart/delete-item', [App\Http\Controllers\CartItemController::class, 'deleteItem'])->name('delete.item');

Route::post('/cart/total-summary', [App\Http\Controllers\CartItemController::class, 'totalSummary'])->name('total.summary');


Route::middleware(['auth'])->group(function () {
    Route::post('/place-order', [App\Http\Controllers\OrderController::class, 'placeOrder'])->name('place.order');

    Route::get('/profile', [App\Http\Controllers\UserController::class, 'profile'])->name('user.profile');
    Route::get('/addresses', [App\Http\Controllers\UserController::class, 'addresses'])->name('user.addresses');
    Route::post('/address/store', [App\Http\Controllers\UserController::class, 'addressStore'])->name('user.address.store');
    Route::post('/address/default', [App\Http\Controllers\UserController::class, 'makeAddressDefault'])->name('make.address.default');
    Route::get('/orders', [App\Http\Controllers\OrderController::class, 'index'])->name('user.orders');
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
