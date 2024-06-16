<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [HomeController::class, 'home'])->name('home.page');

Route::post('/info', [ApiController::class, 'getVideoLink'])->name('video.link');
Route::get('/download', [HomeController::class, 'download'])->name('video.download');