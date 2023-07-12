<?php

use App\Http\Controllers\HomeController;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\TugasRumahController;

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

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('cekLogin', [LoginController::class, 'cekLogin']);

Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard')->middleware('auth');
Route::get('materi', [MateriController::class, 'index'])->name('materi')->middleware('auth');
Route::get('pr', [TugasRumahController::class, 'index'])->name('tugas')->middleware('auth');
Route::get('pengumuman', [PengumumanController::class, 'index'])->name('pengumuman')->middleware('auth');

Route::post('create', [MateriController::class, 'createData'])->name('tambahMateri')->middleware('auth');
