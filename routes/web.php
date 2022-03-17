<?php

use App\Http\Controllers\HomeController;
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

Route::middleware('auth')->group(function(){

    Route::get('/', HomeController::class)->name('home');

    Route::prefix('admin')->middleware('admin')->as('admin.')->group(function(){
        Route::resource('users', UserController::class);
    });

});

require __DIR__.'/auth.php';
