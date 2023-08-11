<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\DiseasesController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PasswordResetController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/article/post', [ArticleController::class, 'createArticle']);
Route::get('/article', [ArticleController::class, 'getArticles']);
Route::get('/article/{key}', [ArticleController::class, 'getArticleById']);
Route::get('/diseases', [DiseasesController::class, 'getDiseases']);
Route::post('/diseases/post', [DiseasesController::class, 'createDiseases']);
Route::post('/register', [RegisterController::class, 'createUserAccount']);
Route::post('/login', [LoginController::class, 'authUserLogin']);
Route::post('/survey', [SurveyController::class, 'storeSurveyData']);
Route::get('/profile/{key}', [UserController::class, 'getUserDataProfile']);
Route::post('/reset-password', [PasswordResetController::class, 'sendToken']);
Route::post('/verify-token', [PasswordResetController::class, 'verifyToken']);
Route::post('/new-password', [PasswordResetController::class, 'newPassword']);
Route::get('/results/{key}', [ResultController::class, 'getResultScan']);
Route::post('/uploads', [ScanController::class, 'scanImage']);


