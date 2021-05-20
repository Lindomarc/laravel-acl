<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('user/{user}/roles',[UserController::class,'roles'])->name('user.roles');
Route::put('user/{user}/roles/sync',[UserController::class,'rolesSync'])->name('user.rolesSync');
Route::resource('user',UserController::class);

Route::get('role/{role}/permissions',[RoleController::class,'permissions'])->name('role.permissions');
Route::put('role/{role}/permissions/sync',[RoleController::class,'permissionsSync'])->name('role.permissionsSync');
Route::resource('role',RoleController::class);

Route::resource('permission',PermissionController::class);
