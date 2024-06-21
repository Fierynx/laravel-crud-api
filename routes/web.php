<?php

use App\Models\Task;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $tasks = Task::latest()->paginate(5);
    return view('home', compact('tasks'));
});
