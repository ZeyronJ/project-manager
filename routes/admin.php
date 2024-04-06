<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProjectController;

Route::prefix('admin')->group(function () {
    //Proyectos
    Route::get('/', [AdminController::class, 'dashboard'])->middleware('auth')->middleware('role:admin')->name('admin.dashboard');
    Route::get('/{id}/assignproject', [ProjectController::class, 'assign_user'])->middleware('auth')->middleware('role:admin')->name('admin.assign_user');

    //Users
    Route::get('/users', [AdminController::class, 'users'])->middleware('auth')->middleware('role:admin')->name('admin.users');
    Route::get('/users/{id}/delete', [AdminController::class, 'user_delete'])->middleware('auth')->middleware('role:admin')->name('admin.user_delete');
    
    Route::get('/users/add', [AdminController::class, 'user_add'])->middleware('auth')->middleware('role:admin')->name('admin.user_add');
    Route::post('/users/adding', [AdminController::class, 'user_adding'])->middleware('auth')->middleware('role:admin')->name('admin.user_adding');

    Route::get('/users/{id}/edit', [AdminController::class, 'user_edit'])->middleware('auth')->middleware('role:admin')->name('admin.user_edit');
    Route::put('/users/{id}/editing', [AdminController::class, 'user_editing'])->middleware('auth')->middleware('role:admin')->name('admin.user_editing');

    Route::get('/users/{id}/user_change_state', [AdminController::class, 'user_change_state'])->middleware('auth')->middleware('role:admin')->name('admin.user_change_state');
    
    //Roles
    Route::get('/roles', [AdminController::class, 'roles'])->middleware('auth')->middleware('role:admin')->name('admin.roles');
    Route::get('/roles/{id}/delete', [AdminController::class, 'role_delete'])->middleware('auth')->middleware('role:admin')->name('admin.role_delete');
    
    Route::get('/roles/add', [AdminController::class, 'role_add'])->middleware('auth')->middleware('role:admin')->name('admin.role_add');
    Route::post('/roles/adding', [AdminController::class, 'role_adding'])->middleware('auth')->middleware('role:admin')->name('admin.role_adding');

    Route::get('/roles/{id}/edit', [AdminController::class, 'role_edit'])->middleware('auth')->middleware('role:admin')->name('admin.role_edit');
    Route::put('/roles/{id}/editing', [AdminController::class, 'role_editing'])->middleware('auth')->middleware('role:admin')->name('admin.role_editing');
    
});
