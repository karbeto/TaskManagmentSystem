<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CategoryController;

#Projects API
Route::get('/projects', [ProjectController::class, 'index']); 
Route::post('/projects', [ProjectController::class, 'store']); 
Route::get('/projects/{id}', [ProjectController::class, 'show']); 
Route::put('/projects/{id}', [ProjectController::class, 'update']); 
Route::delete('/projects/{id}', [ProjectController::class, 'destroy']); 

#Categories API
Route::get('/categories', [CategoryController::class, 'index']); 
Route::post('/categories', [CategoryController::class, 'store']); 

#Tasks API
Route::get('/tasks', [TaskController::class, 'index']); 
Route::post('/tasks', [TaskController::class, 'store']);
Route::put('/tasks/{id}/complete', [TaskController::class, 'markCompleted']);