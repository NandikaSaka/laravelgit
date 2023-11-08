<?php

use App\Http\Controllers\MahasiswaDataController;
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

Route::resource('mahasiswaData', MahasiswaDataController::class);

Route::get('/mahasiswa-data', [MahasiswaDataController::class, 'index']);
