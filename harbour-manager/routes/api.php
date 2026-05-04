<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;

use App\Http\Controllers\ContactController;

Route::get('/projects', [ProjectController::class, 'apiIndex']);
Route::post('/projects/{project}/like', [ProjectController::class, 'apiLike']);
Route::post('/contact', [ContactController::class, 'submit']);
