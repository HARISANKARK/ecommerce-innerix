<?php

use App\Http\Controllers\CategoryController;
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/permissions', App\Http\Controllers\PermissionController::class)->except('destroy');
Route::get('/permissions/destroy/{id}', [App\Http\Controllers\PermissionController::class,'destroy'])->name('permissions.destroy');

Route::get('/roles/destroy/{id}', [App\Http\Controllers\RoleController::class,'destroy'])->name('roles.destroy');
Route::get('/roles/add-permission/{id}', [App\Http\Controllers\RoleController::class,'AddPermissionToRole'])->name('roles.add_permission_to_role');
Route::put('/roles/give-permission/{id}', [App\Http\Controllers\RoleController::class,'GivePermissionToRole'])->name('roles.give_permission_to_role');
Route::resource('/roles', App\Http\Controllers\RoleController::class)->except('destroy');

Route::resource('/users', App\Http\Controllers\UserController::class)->except('destroy');
Route::get('/users/destroy/{id}', [App\Http\Controllers\UserController::class,'destroy'])->name('users.destroy');

Route::group(['middleware'=>['permission:categories']],function(){
    Route::get('/categories/destroy/{id}', [CategoryController::class,'destroy'])->name('categories.destroy');
    Route::resource('categories',CategoryController::class)->except('destroy');
});
