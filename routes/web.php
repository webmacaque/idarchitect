<?php

use App\Http\Controllers\AdminProjectController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminEmployeeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Middleware\OnlyAuth;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProjectController::class, 'index'])->name('index');

Route::get('/projects/{typeSlug}/project/{slug}', [ProjectController::class, 'project'])->name('project');
Route::get('/projects/{slug}', [ProjectController::class, 'projectType'])->name('project-type');

Route::redirect('/login', '/admin/login');
Route::get('/admin/login', [AuthController::class, 'loginForm'])->name('login-form');
Route::post('/admin/login', [AuthController::class, 'login'])->name('login-action');

Route::middleware('auth')->group(function() {
    // Projects routes
    Route::get('/admin/projects', [AdminProjectController::class, 'projects'])->name('admin-projects');
    Route::get('/admin/projects/create', [AdminProjectController::class, 'createForm'])->name('admin-projects-create-form');
    Route::get('/admin/projects/{id}', [AdminProjectController::class, 'project'])->name('admin-projects-item')->where('id', '[0-9]+');
    Route::get('/admin/projects/{id}/edit', [AdminProjectController::class, 'editForm'])->name('admin-projects-item-edit-form')->where('id', '[0-9]+');
    Route::get('/admin/projects/{id}/preview', [AdminProjectController::class, 'preview'])->name('admin-projects-item-preview')->where('id', '[0-9]+');

    Route::post('/admin/projects/create', [AdminProjectController::class, 'create'])->name('admin-projects-create-action');
    Route::post('/admin/projects/{id}/edit', [AdminProjectController::class, 'edit'])->name('admin-projects-edit-action')->where('id', '[0-9]+');
    Route::post('/admin/projects/delete', [AdminProjectController::class, 'delete'])->name('admin-projects-delete');

    // Users routes
    Route::get('/admin/users', [AdminUserController::class, 'users'])->name('admin-users');
    Route::get('/admin/users/create', [AdminUserController::class, 'createForm'])->name('admin-users-create');
    Route::get('/admin/users/{id}/edit', [AdminUserController::class, 'editForm'])->name('admin-users-edit')->where('id', '[0-9]+');

    Route::post('/admin/users/create', [AdminUserController::class, 'create'])->name('admin-users-store');
    Route::put('/admin/users/{id}', [AdminUserController::class, 'update'])->name('admin-users-update')->where('id', '[0-9]+');
    Route::delete('/admin/users/delete', [AdminUserController::class, 'delete'])->name('admin-users-delete');

    // Employees routes
    Route::get('/admin/employees', [AdminEmployeeController::class, 'index'])->name('admin-employees');
    Route::get('/admin/employees/create', [AdminEmployeeController::class, 'create'])->name('admin-employees-create');
    Route::get('/admin/employees/{id}/edit', [AdminEmployeeController::class, 'edit'])->name('admin-employees-edit')->where('id', '[0-9]+');

    Route::post('/admin/employees', [AdminEmployeeController::class, 'store'])->name('admin-employees-store');
    Route::put('/admin/employees/{id}', [AdminEmployeeController::class, 'update'])->name('admin-employees-update')->where('id', '[0-9]+');
    Route::delete('/admin/employees/delete', [AdminEmployeeController::class, 'destroy'])->name('admin-employees-delete');
    Route::post('/admin/employees/{id}/reorder', [AdminEmployeeController::class, 'reorder'])->name('admin-employees-reorder')->where('id', '[0-9]+');

    Route::get('/admin/logout', [AuthController::class, 'logout'])->name('logout');
});






