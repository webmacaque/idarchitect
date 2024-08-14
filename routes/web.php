<?php

use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProjectController::class, 'index'])->name('index');

Route::get('/projects/{slug}', [ProjectController::class, 'projectType'])->name('project-type');

Route::get('/test/', function () {
    return [
        fake()->slug,
        fake()->imageUrl
        ];
});
