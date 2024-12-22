<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Frontend\HomeController;
use Illuminate\Support\Facades\Route;

/** Admin Route */
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->middleware(['role:admin'])->name('admin.dashboard');

