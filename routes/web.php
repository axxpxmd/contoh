<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UploadController::class, 'index']);
Route::post('/upload', [UploadController::class, 'upload'])->name('upload');
