<?php

use App\Http\Controllers\authenticationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\indexController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectHasContentController;
use App\Models\projectHasContent;
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


// Api Register and login Routes
Route::post('apiRegister', [authenticationController::class, 'api_register']);
Route::post('apiLogin', [authenticationController::class, 'api_login']);



// projects Routes
Route::get('projects', [ProjectController::class, 'index']);
Route::get('project/{id}', [ProjectController::class, 'show']);
Route::get('category-filter/{id}', [ProjectController::class, 'categoryFilter']);






//category Routes
Route::get('categories', [CategoryController::class, 'index']);



// Project Content uploads
Route::get('project-content/{project_id}', [ProjectController::class, 'projectContent']);
Route::post('project-content-upload', [ProjectController::class, 'contentUpload']);
Route::post('thumbnail-upload', [ImageController::class, 'thumbnailUpload']);



// Home User Details
Route::get('user-details', [indexController::class, 'getUserDetails']);
Route::get('user-projects/{user_id}', [indexController::class, 'userProjects']);
Route::post('user-category-project-filter', [ProjectController::class, 'userCategoryWisedProject']);




//content Remover Routes 
Route::post('project-content-remover', [ProjectController::class, 'contentDelete']);
Route::post ('project-text-remover', [ProjectController::class, 'textDelete']);



//content image Updates Routes
Route::post('update-project-image', [ProjectController::class, 'imageUpdate']);
Route::post('text-content-update', [ProjectHasContentController::class, 'updateText']);


//project publisher
Route::post('active-project', [ProjectController::class, 'activeProject']);


//Protected Routes
Route::middleware(['auth:sanctum'])->group(function () {

    Route::post('apiLogout', [authenticationController::class, 'api_logout']);
    Route::get('checkUser', [indexController::class, 'index']);
    Route::post('project-save', [ProjectController::class, 'store']);
    Route::post('project-update/{id}', [ProjectController::class, 'update']);
    
});




