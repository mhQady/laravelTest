<?php

use App\Http\Controllers\admin\products\productcontroller;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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


Route::group(['namespace' => 'admin\products', 'prefix' => 'products', 'middleware' => ['auth', 'verified']], function () {
    Route::group(['namespace' => 'admin\dashboard'], function () {
        Route::get('/admin', 'dashboardController@index');
    });
    Route::get('all', 'productcontroller@index');
    Route::get('create', [productcontroller::class, 'create']);
    Route::post('store', [productcontroller::class, 'store']);
    Route::get('edit/{id}', [productcontroller::class, 'edit']);
    Route::put('update/{id}', [productcontroller::class, 'update']);
    Route::delete('delete/{id}', [productcontroller::class, 'delete']);
});


Auth::routes(['verify', true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
