<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get("/tasks", [TaskController::class, 'getTasks'])->middleware('role:Staff', 'auth:sanctum');
Route::post("/create-task", [TaskController::class, 'createTask'])->middleware( 'role:Admin', 'auth:sanctum');
Route::post("/update-task/{id}", [TaskController::class, 'updateTask'])->middleware( 'role:Admin', 'auth:sanctum');
Route::delete("/delete-task/{id}", [TaskController::class, 'deleteTask'])->middleware( 'role:Admin', 'auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');