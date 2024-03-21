<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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


//first page route
Route::get('/',function(){

    return view('customer/dashboard');
    
});


//Route group for user authentication and login
Route::prefix('auth/user')->group(fn()=>[

    Route::post('/registration',[AuthController::class,'store'])->name('user.registration'),
    Route::get('/logout',[AuthController::class,'logout'])->middleware(['auth'])->name('user.logout')->middleware(['auth']),
    Route::post('/login',[AuthController::class,'login'])->name('user.login'),
]);


//Route group for rest of user view and actions
Route::prefix('user')->group(fn()=>[

    Route::get('/dashboard',[UserController::class,'index'])->name('customer.dashboard'),
    Route::get('login-form',[AuthController::class,'showLoginPage'])->name('user.login.form'),
    Route::get('/register-form',[AuthController::class,'showRegisterForm'])->name('user.register.form'),
]);



//route group for users' products crud operations
Route::prefix('customer/product')->middleware(['auth'])->group(fn()=>[
        Route::get('/create-product-form',[ProductController::class,'create'])->name('customer.product.create-form'),
        Route::post('/create-product',[ProductController::class,'store'])->name('customer.product.store'),
        Route::post('/update-product/{id}',[ProductController::class,'update'])->name('customer.product.update'),
        Route::post('/delete-product/{id}',[ProductController::class,'update'])->name('customer.product.destroy'),
        Route::get('/view-products/{id}',[ProductController::class,'index'])->name('customer.product.index'),
        Route::get('/product/{id}',[ProductController::class,'show'])->name('customer.product.show'),
        Route::get('update-product-form',[ProductController::class,'edit'])->name('customer.product.edit-form'),

]);