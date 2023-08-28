<?php

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// Route to get access token
// Route::get('/get-access-token', [ApiController::class, 'getAccessToken']);

// Route to get access token
// Route::get('/get-grant-token', [ApiController::class, 'generateGrantToken']);

// Route to refresh token
// Route::get('/refresh-token', [ApiController::class, 'refreshToken']);

// Route to get question
Route::get('/get-question', [ApiController::class, 'getQuestion']);