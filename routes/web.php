<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RayonController;
use App\Http\Controllers\RombelController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\LateController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::resources([
    'user'=>UserController::class
]);

Route::resources([
    'rayon'=>RayonController::class
]);

Route::resources([
    'rombel'=>RombelController::class
]);

Route::resources([
    'student'=>StudentController::class
]);

Route::resources([
    'late'=>LateController::class
]);

Route::get('/rekapitulasi-data', [LateController::class, 'rekapitulasi'])->name('rekapitulasi');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'auth'])->name('login.auth');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
