<?php

use App\Http\Controllers\BranchController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
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