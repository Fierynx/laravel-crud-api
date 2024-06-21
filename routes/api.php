<?php

use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get("/tasks", [TaskController::class, 'getTasks']);
Route::post("/create-task", [TaskController::class, 'createTask']);
Route::post("/update-task/{id}", [TaskController::class, 'updateTask']);
Route::delete("/delete-task/{id}", [TaskController::class, 'deleteTask']);
