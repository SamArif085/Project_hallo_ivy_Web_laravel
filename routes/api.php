<?php

// header('Access-Control-Allow-Origin:  *');
// header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, DELETE');
// header("Access-Control-Allow-Origin: *");
// header("Content-Type: application/json; charset=UTF-8");

use Illuminate\Support\Facades\Route;
// use Illuminate\Http\Request;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\Api\TesController;
// use App\Http\Controllers\LoginController;

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

// Route::get('/test', [TesController::class, 'index']);
Route::post('/test', [TesController::class, 'getUsers']);
Route::post('create', [MateriController::class, 'createData']);
