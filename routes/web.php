<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
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

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/', [HomeController::class, 'login'])->name('home');
Route::post('/', [HomeController::class, 'processLogin']);

Route::post('/logout', [HomeController::class, 'logout'])->name('logout');

// Routes for branches
Route::group(['prefix' => 'branch'], function () {
    Route::get('data', [BranchController::class, 'index'])->name('branches');
    Route::get('{id}/show', [BranchController::class, 'show'])->name('show-branch');
    Route::get('create', [BranchController::class, 'create'])->name('create-branch');
    Route::post('create', [BranchController::class, 'store']);
    Route::get('{id}/edit', [BranchController::class, 'edit'])->name('edit-branch');
    Route::patch('{id}/edit', [BranchController::class, 'update']);
    Route::delete('{id}/delete', [BranchController::class, 'destroy'])->name('delete-branch');
});

// Routtes for clients
Route::group(['prefix' => 'client'], function () {
    Route::controller(ClientController::class)->group(function () {
        Route::get('data', 'index')->name('clients');
        Route::get('create', 'create')->name('create-client');
        Route::post('create', 'store');
        Route::get('edit/{client}', 'edit')->name('edit-client');
        Route::patch('edit/{client}', 'update');
        Route::get('show/{client}', 'show')->name('show-client');
        Route::delete('delete/{client}', 'destroy')->name('delete-client');
    });
});

//Routes for users
Route::group(['prefix' => 'user'], function () {
    Route::controller(UserController::class)->group(function () {
        Route::get('data', 'index')->name('users');
        Route::get('create', 'create')->name('create-user');
        Route::post('create', 'store');
        Route::get('edit/{user}', 'edit')->name('edit-user');
        Route::patch('edit/{user}', 'update');
        Route::get('show/{user}', 'show')->name('show-user');
        Route::delete('delete/{user}', 'destroy')->name('delete-user');
        Route::get('{user}/assign_role', 'index_role')->name('assign-role');
        Route::post('{user}/assign_role', 'assign_role');
    });
});

//Routes for roles
Route::group(['prefix' => 'user/role'], function () {
    Route::controller(RoleController::class)->group(function () {
        Route::get('data', 'index')->name('roles');
        Route::get('create', 'create')->name('create-role');
        Route::post('create', 'store');
        Route::get('edit/{role}', 'edit')->name('edit-role');
        Route::patch('edit/{role}', 'update');
        Route::get('show/{role}', 'show')->name('show-role');
        Route::delete('delete/{role}', 'destroy')->name('delete-role');
        Route::get('{role}/assign-permission', 'assign_permissions_index')->name('assign_permissions');
        Route::post('{role}/assign-permission', 'assign_permissions_store');
        Route::post('remove-permission/{id}', 'remove_permission')->name('detach-permission');
    });
});

//Routes for permissions
Route::group(['prefix' => 'user/permission'], function () {
    Route::controller(PermissionController::class)->group(function () {
        Route::get('data', 'index')->name('permissions');
        Route::get('create', 'create')->name('create-permission');
        Route::post('create', 'store');
        Route::get('edit/{permission}', 'edit')->name('edit-permission');
        Route::patch('edit/{permission}', 'update');
        Route::get('show/{permission}', 'show')->name('show-permission');
        Route::delete('delete/{permission}', 'destroy')->name('delete-permission');
    });
});