<?php

use App\Http\Controllers\authenticationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\indexController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



// Public Routes
Route::get('projects', [ProjectController::class, 'index']);
Route::get('categories', [CategoryController::class, 'index']);
Route::post('apiRegister', [authenticationController::class, 'api_register']);
Route::post('apiLogin', [authenticationController::class, 'api_login']);

Route::get('project/{id}', [ProjectController::class, 'show']);


Route::post('thumbnail-upload', [ImageController::class, 'thumbnailUpload']);


//Protected Routes
Route::middleware(['auth:sanctum'])->group(function () {

    Route::post('apiLogout', [authenticationController::class, 'api_logout']);
    Route::get('checkUser', [indexController::class, 'index']);
    Route::post('project-save', [ProjectController::class, 'store']);
    
});




