<?php

use App\Http\Controllers\Panel\Admin\DashboardController;
use App\Http\Controllers\Panel\LoginController;
use App\Http\Controllers\Panel\RegisterController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('register', [RegisterController::class, 'create'])->name('register.form');
Route::post('register', [RegisterController::class, 'store'])->name('register');
Route::get('login', [LoginController::class, 'create'])->name('login.form');
Route::post('login', [LoginController::class, 'login'])->name('login');

Route::group(['prefix' => 'admin'], function () {
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');

});
