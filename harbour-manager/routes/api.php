<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;

Route::get('/projects', [ProjectController::class, 'apiIndex']);
Route::post('/projects/{project}/like', [ProjectController::class, 'apiLike']);
