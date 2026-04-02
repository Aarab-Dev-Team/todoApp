<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController ; 

Route::get('/', function () {
    return view('join') ; 
})->name('join');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //todo routes
    Route::get('/', [TodoController::class, 'index'])->name('todos.index');
    Route::post('/todos', [TodoController::class, 'create'])->name('todos.store');
    Route::put('/todos/{id}', [TodoController::class, 'update'])->name('todos.update');
    Route::delete('/todos/{id}', [TodoController::class, 'destroy'])->name('todos.delete');
    Route::patch('/todos/{id}/toggle', [TodoController::class, 'toggle'])->name('todos.toggle');
});

require __DIR__.'/auth.php';
