<?php

use App\Http\Controllers\AdminProjectController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExecuteArtisanCommandController;
use App\Http\Controllers\ProjectController;
use App\Http\Middleware\OnlyAuth;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProjectController::class, 'index'])->name('index');

Route::get('/projects/{typeSlug}/project/{slug}', [ProjectController::class, 'project'])->name('project');
Route::get('/projects/{slug}', [ProjectController::class, 'projectType'])->name('project-type');

Route::get('/admin/login', [AuthController::class, 'loginForm'])->name('login-form');
Route::post('/admin/login', [AuthController::class, 'login'])->name('login-action');

Route::middleware('auth')->group(function() {
    Route::get('/admin/projects', [AdminProjectController::class, 'projects'])->name('admin-projects');
    Route::get('/admin/projects/create', [AdminProjectController::class, 'createForm'])->name('admin-projects-create-form');
    Route::get('/admin/projects/{id}', [AdminProjectController::class, 'project'])->name('admin-projects-item')->where('id', '[0-9]+');
    Route::get('/admin/projects/{id}/edit', [AdminProjectController::class, 'editForm'])->name('admin-projects-item-edit-form')->where('id', '[0-9]+');
    Route::get('/admin/projects/{id}/preview', [AdminProjectController::class, 'preview'])->name('admin-projects-item-preview')->where('id', '[0-9]+');

    Route::post('/admin/projects/create', [AdminProjectController::class, 'create'])->name('admin-projects-create-action');
    Route::post('/admin/projects/{id}/edit', [AdminProjectController::class, 'edit'])->name('admin-projects-edit-action')->where('id', '[0-9]+');
    Route::post('/admin/projects/delete', [AdminProjectController::class, 'delete'])->name('admin-projects-delete');

    Route::get('/admin/users', [AdminUserController::class, 'users'])->name('admin-users');
    Route::get('/admin/users/create', [AdminUserController::class, 'createForm'])->name('admin-users-create-form');
    Route::get('/admin/users/{id}/edit', [AdminUserController::class, 'editForm'])->name('admin-users-item-edit-form')->where('id', '[0-9]+');

    Route::post('/admin/users/create', [AdminUserController::class, 'create'])->name('admin-users-create-action');
    Route::post('/admin/users/{id}/edit', [AdminUserController::class, 'edit'])->name('admin-users-item-edit-action')->where('id', '[0-9]+');
    Route::post('/admin/users/delete', [AdminUserController::class, 'delete'])->name('admin-users-delete');

    Route::get('/admin/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('/run-command/{name_of_command}', ExecuteArtisanCommandController::class);





