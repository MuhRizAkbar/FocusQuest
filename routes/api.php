<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
Route::get('/dashboard', [AdminController::class, 'getDashboardData']);
Route::post('/save-results', [AdminController::class, 'saveResults']);
Route::get('/raw-data', [AdminController::class, 'getRawDataAPI']); // Add this line