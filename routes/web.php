<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;


Route::get('/',[TodoController::class , "index"])->name("todos.index");

Route::post('/' , [TodoController::class , "create"])->name('todos.store'); 


Route::delete('/todos/{id}' , [TodoController::class , "destroy"])->name('todos.delete'); 
Route::put('/todos/{id}' , [TodoController::class , "update"])->name('todos.update')  ; 
Route::put('todos/{id}/toggle',[TodoController::class , "toggle"])->name('todos.toggle') ; 
