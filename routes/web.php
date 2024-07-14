<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VideoUploadController;

Route::get('convert-video', [VideoUploadController::class, 'convertVideo']);
Route::get('/', [VideoUploadController::class, 'showForm']);
Route::post('/upload', [VideoUploadController::class, 'uploadVideo']);
Route::get('/videos/{resolution}/{filename}', [VideoUploadController::class, 'serveVideo'])->name('serveVideo');
