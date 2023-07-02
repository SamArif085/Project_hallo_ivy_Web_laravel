<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return view('dashboard', [
        "title" => "Dashboard"
    ]);
});
Route::get('/dashboard', function () {
    return view('dashboard', [
        "title" => "Dashboard"
    ]);
});
Route::get('/materi', function () {
    return view('materi', [
        "title" => "Materi"
    ]);
});
Route::get('/pr', function () {
    return view('pr', [
        "title" => "Pr"
    ]);
});
Route::get('/pengumuman', function () {
    return view('pengumuman', [
        "title" => "Pengumuman"
    ]);
});
