<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ChangePasswordController;

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

Route::group(['middleware' => 'auth'], function() {
    Route::group(['prefix' => '/admin', 'as'=>'admin.'], function() {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
		Route::post('/profile', [ProfileController::class, 'update'])->name('profile');

        Route::get('/change_password', [ChangePasswordController::class, 'index'])->name('change_password');
		Route::post('/change_password', [ChangePasswordController::class, 'update'])->name('change_password');

        Route::get('/permissions/update/status', [PermissionController::class, 'updateStatus'])->name('permissions.update.status');
        Route::delete('/permissions/destroy', [PermissionController::class, 'massDestroy'])->name('permissions.massDestroy');
        Route::resource('/permissions', PermissionController::class);

        Route::get('/roles/update/status', [RoleController::class, 'updateStatus'])->name('roles.update.status');
        Route::delete('/roles/destroy', [RoleController::class, 'massDestroy'])->name('roles.massDestroy');
        Route::resource('/roles', RoleController::class);

        Route::get('/users/update/status', [UserController::class, 'updateStatus'])->name('users.update.status');
        Route::delete('/users/destroy', [UserController::class, 'massDestroy'])->name('users.massDestroy');
        Route::resource('/users', UserController::class);
    });
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
