<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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
    return view('auth.login');
});

Auth::routes();

// BASIC ROUTES
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::resource('/permissions', PermissionController::class)->except('destroy');
Route::get('/permissions/destroy/{id}', [PermissionController::class,'destroy'])->name('permissions.destroy');

Route::get('/roles/destroy/{id}', [RoleController::class,'destroy'])->name('roles.destroy');
Route::get('/roles/add-permission/{id}', [RoleController::class,'AddPermissionToRole'])->name('roles.add_permission_to_role');
Route::put('/roles/give-permission/{id}', [RoleController::class,'GivePermissionToRole'])->name('roles.give_permission_to_role');
Route::resource('/roles', RoleController::class)->except('destroy');

Route::resource('/users', UserController::class)->except('destroy');
Route::get('/users/destroy/{id}', [UserController::class,'destroy'])->name('users.destroy');

// END BASIC ROUTES


Route::group(['middleware'=>['permission:categories']],function(){
    Route::get('/categories/destroy/{id}', [CategoryController::class,'destroy'])->name('categories.destroy');
    Route::resource('categories',CategoryController::class)->except('destroy');
});

Route::group(['middleware'=>['permission:products']],function(){
    Route::get('/products/destroy/{id}', [ProductController::class,'destroy'])->name('products.destroy');
    Route::resource('products',ProductController::class)->except('destroy');
});

Route::group(['middleware'=>['permission:orders']],function(){

    Route::get('/orders/destroy/{id}', [OrderController::class,'destroy'])->name('orders.destroy');
    Route::get('/orders/create/{id}', [OrderController::class,'create'])->name('orders.create');
    Route::resource('orders',OrderController::class)->except(['destroy','create']);
});
