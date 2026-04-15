<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StoreController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| الصفحة الرئيسية (عرض المنتجات)
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    $products = Product::all();
    return view('welcome', compact('products'));
});


/*
|--------------------------------------------------------------------------
| تسجيل الدخول
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showlogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');


/*
|--------------------------------------------------------------------------
| عربة التسوق (متاحة بدون تسجيل دخول)
|--------------------------------------------------------------------------
*/
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

/* ✅ هذا هو السطر الذي كان ناقص ويسبب الخطأ */
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');

Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');


/*
|--------------------------------------------------------------------------
| لوحة التحكم (محمي بتسجيل الدخول)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [StoreController::class, 'index'])->name('dashboard');

    // عرض المنتجات في لوحة الأدمن
    Route::get('/admin/products', [ProductController::class, 'index'])
        ->name('admin.products.index');

    // إنشاء منتج
    Route::get('/admin/products/create', [ProductController::class, 'create'])
        ->name('admin.products.create');

    Route::post('/admin/products', [ProductController::class, 'store'])
        ->name('admin.products.store');

    // تعديل منتج
    Route::get('/admin/products/{id}/edit', [ProductController::class, 'edit'])
        ->name('admin.products.edit');

    Route::put('/admin/products/{id}', [ProductController::class, 'update'])
        ->name('admin.products.update');

    // حذف منتج
    Route::delete('/admin/products/{id}', [ProductController::class, 'destroy'])
        ->name('admin.products.destroy');
});