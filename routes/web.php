<?php

use App\Http\Controllers\authenticationController;
use App\Models\project;
use App\Models\User;
use Illuminate\Http\Request;
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




Route::post('register', [authenticationController::class, 'register_post'])->name('register_post');
Route::get('register', [authenticationController::class, 'registerGet'])->name('registerGet');
Route::get('login', [authenticationController::class, 'loginGet'])->name('login');
Route::post('login', [authenticationController::class, 'login_post'])->name('login_post');
Route::get('signout',[authenticationController::class, 'signout'])->name('logout');


Route::middleware(['auth'])->group(function () {

    Route::get('/', function () {
        return view('index');
    })->name('home');

});





// --------------------------- Testing Area ---------------------------

Route::get('test', function () {
    return User::with('projects')->find(1);
});