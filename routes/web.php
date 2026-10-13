<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TaskController; // baru

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    $user = Auth::user();

    $tasks = $user->tasks()->latest()->paginate(5)->withQueryString();

    $totalTasks = $user->tasks()->count();

    $pendingTasks = $user->tasks()
        ->where('status', 'Belum Dikerjakan')
        ->count();

    $inProgressTasks = $user->tasks()
        ->where('status', 'Dikerjakan')
        ->count();

    $completedTasks = $user->tasks()
        ->where('status', 'Selesai')
        ->count();

        
    $overdueTasks = $user->tasks()
        ->where('status', '!=', 'Selesai')
        ->whereNotNull('due_date')
        ->whereDate('due_date', '<', now()->toDateString())
        ->count();

    $dueTodayTasks = $user->tasks()
        ->where('status', '!=', 'Selesai')
        ->whereNotNull('due_date')
        ->whereDate('due_date', now()->toDateString())
        ->count();

    $overdueTasks = $user->tasks()
        ->whereNotIn('status', ['Selesai'])
        ->whereNotNull('due_date')
        ->whereDate('due_date', '<', now()->toDateString())
        ->count();

    $dueTodayTasks = $user->tasks()
        ->whereNotIn('status', ['Selesai'])
        ->whereNotNull('due_date')
        ->whereDate('due_date', now()->toDateString())
        ->count();

    
    return view('dashboard', compact(
        'tasks',
        'totalTasks',
        'pendingTasks',
        'inProgressTasks',
        'completedTasks',
        'overdueTasks',
        'dueTodayTasks'
    ));
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route untuk resource TaskController
Route::middleware('auth')->group(function () {
    Route::resource('tasks', TaskController::class);
});

require __DIR__.'/auth.php';
