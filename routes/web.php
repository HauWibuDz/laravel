<?php

use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Home
// Route::get('/', function () {
//     return view('home');
// })->name('home');
Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/danhmuc/{id}', [HomeController::class, 'danhmuc'])->name('danhmuc');
Route::get('/show/{id}', [HomeController::class, 'show'])->name('show');
Route::get('/showCart', [CartController::class, 'showCart'])->name('showcart');
Route::post('/cart/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('update-cart/{id}', [CartController::class, 'update'])->name('cart.update');
Route::get('delete-cart/{id}', [CartController::class, 'delete'])->name('cart.delete');

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');


    Route::resource('category', CategoryController::class);
    Route::resource('product', ProductController::class);

    //category
    // Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    // Route::get('/category-add', [CategoryController::class, 'add'])->name('category.add');
    // Route::post('/category-add', [CategoryController::class, 'create']);
    // Route::get('/category-delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');
    // Route::get('/category-edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    // Route::post('/category-update/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::get('/category-softDelete', [CategoryController::class, 'softDelete'])->name('category.softDelete');
    Route::get('/restore/{id}', [CategoryController::class, 'restore'])->name('category.restore');
    Route::get('/forceDelete/{id}', [CategoryController::class, 'forceDelete'])->name('category.forceDelete');


    // //product    
    // Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    // Route::get('/product-add', [ProductController::class, 'add'])->name('product.add');
    // Route::post('/product-add', [ProductController::class, 'create']);
    // Route::get('/product-delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
    // Route::get('/product-edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    // Route::post('/product-update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::get('/product-softDelete', [ProductController::class, 'softDelete'])->name('product.softDelete');
    Route::get('/restore/{id}', [ProductController::class, 'restore'])->name('product.restore');
    Route::get('/forceDelete/{id}', [ProductController::class, 'forceDelete'])->name('product.forceDelete');
});




//register
Route::get('/register', [UserController::class, 'register'])->name('register.index');
Route::post('/register', [UserController::class, 'postRegister'])->name('register.create');

//login
Route::get('/login', [UserController::class, 'login'])->name('login.index');
Route::post('/login', [UserController::class, 'postLogin']);


// Route::get('/logout', [UserController::class, 'logout'])->name('user.logout');

Route::get('logon', [UserController::class, 'logon'])->name('admin.login');
Route::post('logon', [UserController::class, 'postLogon']);
Route::get('logout', [UserController::class, 'logout'])->name('admin.logout');