<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ProjectController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('projects', ProjectController::class)->except(['show'])->names('admin.projects');
    Route::delete('/admin/projects/media/{media}', [ProjectController::class, 'storeMedia'])->name('admin.projects.media.store');
    Route::delete('/admin/projects/media/{media}', [ProjectController::class, 'destroyMedia'])->name('admin.projects.media.destroy');
    Route::get('/profile', [ProfileController::class, 'index'])->name('admin.profile.index');
    Route::post('/profile', [ProfileController::class, 'update'])->name('admin.profile.update');
    Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('admin.profile.updatePassword');
});
