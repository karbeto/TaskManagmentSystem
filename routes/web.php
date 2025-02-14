<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CategoryController;

Route::resource('categories', CategoryController::class);
Route::resource('projects', ProjectController::class);
Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
Route::patch('/tasks/{task}/complete', [TaskController::class, 'markCompleted'])->name('tasks.complete');
