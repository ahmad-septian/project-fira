<?php

use App\Http\Controllers\AuthContoller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('dashboard');
// });
// Route::get('/mahasiswa', function () {
//     return view('mahasiswa');
// })->name('mahasiswa');
Route::get('/login', [AuthContoller::class, 'showlogin'])->name('login');
Route::post('/login', [AuthContoller::class, 'login']);
Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    });

    Route::get('/mahasiswa', function () {
        return view('mahasiswa');
    })->name('mahasiswa');

    Route::get('/logout', [AuthContoller::class, 'logout'])->name('logout');
});