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
Route::post('cek', [LoginController::class, 'cekLogin'])->name('cekLogin');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard')->middleware('auth');
Route::get('materi', [MateriController::class, 'index'])->name('materi')->middleware('auth');
Route::get('detail/{kode_kel}', [MateriController::class, 'detailData'])->name('detail')->middleware('auth');
Route::get('tugasRumah', [TugasRumahController::class, 'index'])->name('tugas')->middleware('auth');
Route::get('detailQuiz/{id_materi}', [MateriController::class, 'detailQuiz'])->name('detQuiz')->middleware('auth');

Route::post('/createTema', [MateriController::class, 'createData'])->name('tambahMateri')->middleware('auth');
Route::post('/updateTema', [MateriController::class, 'updateData'])->name('editMateri')->middleware('auth');
Route::post('/deleteTema', [MateriController::class, 'deleteData'])->name('hapusMateri')->middleware('auth');

Route::get('/detailShow/{id_materi}', [MateriController::class, 'showData'])->middleware('auth');
Route::get('/detailDataQuiz/{id_quiz}', [MateriController::class, 'detailDataQuiz'])->middleware('auth');

Route::post('/createQuiz', [MateriController::class, 'createDataQuiz'])->middleware('auth');
