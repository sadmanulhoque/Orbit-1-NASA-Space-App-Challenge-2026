<?php

use App\Http\Controllers\Frontend\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/assessment/create', [HomeController::class, 'create'])->name('assessment.create');
Route::post('/assessment/store', [HomeController::class, 'storeAssessment'])->name('assessment.store');
Route::get('/hazards', [HomeController::class, 'hazards'])->name('hazards.index');
Route::get('/surgeon', [HomeController::class, 'surgeon'])->name('surgeon.index');
