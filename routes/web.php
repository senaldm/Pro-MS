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

    return view('welcome');
    
})->name('user.login');


//Route group for user authentication and login
Route::prefix('user')->group(fn()=>[

    Route::post('/registration',[AuthController::class,'store'])->name('customer.registration'),
    Route::post('/logout',[AuthController::class,'logout'])->middleware(['auth'])->name('user.logout'),
    Route::post('/login',[UserController::class,'login'])->name('customer.login'),
]);



//route group for users' products crud operations
Route::prefix('customer/product')->middleware(['auth'])->group(fn()=>[

        Route::post('/create-product',[ProductController::class,'store'])->name('customer.product.store'),
        Route::post('/update-product/{id}',[ProductController::class,'update'])->name('customer.product.update'),
        Route::post('/delete-product/{id}',[ProductController::class,'update'])->name('customer.product.destroy'),
        Route::get('/view-products',[ProductController::class,'index'])->name('customer.product.index'),
]);