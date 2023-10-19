<?php

use App\Http\Controllers\AdminController;
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
Route::get('dashboardAdmin', [AdminController::class, 'index'])->name('dashboardAdmin')->middleware('auth');
Route::get('materi', [MateriController::class, 'index'])->name('materi')->middleware('auth');
Route::get('detail/{kode_kel}', [MateriController::class, 'detailData'])->name('detail')->middleware('auth');
Route::get('detailQuiz/{id_materi}', [MateriController::class, 'detailQuiz'])->name('detQuiz')->middleware('auth');

Route::post('/createTema', [MateriController::class, 'createData'])->name('tambahMateri')->middleware('auth');
Route::post('/updateTema', [MateriController::class, 'updateData'])->name('editMateri')->middleware('auth');
Route::post('/deleteTema', [MateriController::class, 'deleteData'])->name('hapusMateri')->middleware('auth');

Route::get('/detailShow/{id_materi}', [MateriController::class, 'showData'])->middleware('auth');
Route::get('/detailDataQuiz/{id_quiz}', [MateriController::class, 'detailDataQuiz'])->middleware('auth');

Route::post('/createQuiz', [MateriController::class, 'createDataQuiz'])->name('tambahQuiz')->middleware('auth');
Route::post('/updateQuiz', [MateriController::class, 'updateDataQuiz'])->name('ubahQuiz')->middleware('auth');
Route::post('/deleteQuiz', [MateriController::class, 'deleteDataQuiz'])->middleware('auth');

Route::get('dataKelas', [AdminController::class, 'dataKelas'])->name('dataKelas')->middleware('auth');
Route::get('dataGuru/{kode_kls}', [AdminController::class, 'dataGuru'])->name('dataGuru')->middleware('auth');
Route::post('/createGuru', [AdminController::class, 'createGuru'])->middleware('auth');
Route::post('/updateGuru', [AdminController::class, 'updateGuru'])->middleware('auth');
Route::post('/deleteGuru', [AdminController::class, 'deleteGuru'])->middleware('auth');
Route::get('/detailGuru/{id_guru}', [AdminController::class, 'detailGuru'])->middleware('auth');

Route::get('dataSiswa', [AdminController::class, 'dataSiswa'])->name('dataSiswa')->middleware('auth');
Route::post('/createKelas', [AdminController::class, 'createKelas'])->middleware('auth');
Route::post('/updateKelas', [AdminController::class, 'updateKelas'])->middleware('auth');
// Route::post('/deleteGuru', [AdminController::class, 'deleteGuru'])->middleware('auth');
Route::get('/detailKelas/{kode_kelas}', [AdminController::class, 'showDataKelas'])->middleware('auth');

Route::get('detailDataSiswa/{kode_kelas}', [AdminController::class, 'detailDataSiswa'])->name('detailDataSiswa')->middleware('auth');
Route::get('/detailSiswa/{nisn}', [AdminController::class, 'detailSiswa'])->middleware('auth');
Route::post('/createSiswa', [AdminController::class, 'tambahSiswa'])->middleware('auth');
Route::post('/updateSiswa', [AdminController::class, 'ubahSiswa'])->middleware('auth');

Route::get('tugasRumah', [TugasRumahController::class, 'index'])->name('tugas')->middleware('auth');
Route::post('/createTugasRumah', [TugasRumahController::class, 'createDataTugasRumah'])->name('tambahPR')->middleware('auth');
Route::get('/detailShowPR/{id}', [TugasRumahController::class, 'showDataPR'])->middleware('auth');
Route::post('/updateDataTugasRumah', [TugasRumahController::class, 'updateTugasRumah'])->middleware('auth');
Route::post('/deleteDataTugasRumah', [TugasRumahController::class, 'deleteTugasRumah'])->middleware('auth');
