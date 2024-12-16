<?php

use App\Http\Controllers\GeminiController;
use Illuminate\Support\Facades\Route;

Route::get('/', [GeminiController::class, 'index'])->name('index');
Route::post('/gemini', [GeminiController::class, 'gemini_content'])->name('gemini.content');