<?php

use App\Http\Controllers\TaskController;
use App\Repository\TaskRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $tasks = [];
    if (Auth::user()) $tasks = (new TaskRepository())->getRecentTasksOfCurrentUser();
    return view('welcome', compact('tasks'));
})->name('welcome');

// routes for authentications
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');

Route::prefix('task')->group(function () {
    Route::get('/', [TaskController::class, 'tasksList'])
        ->name('task.all');

    Route::get('/create', [TaskController::class, 'createTask'])
        ->name('task.create');
    Route::post('/create', [TaskController::class, 'saveTask'])
        ->name('task.save');

    Route::get('/{id}', [TaskController::class, 'showOneTask'])
        ->name('task.view');

    Route::get('/{id}/delete', [TaskController::class, 'deleteTask'])
        ->name('task.delete');

    Route::get('/{id}/edit', [TaskController::class, 'editTask'])
        ->name('task.edit');

    Route::post('/{id}/update', [TaskController::class, 'updateTask'])
        ->name('task.update');
    Route::get('/{id}/update', [TaskController::class, 'editTask']);

    Route::get('/{id}/complete', [TaskController::class, 'completeTask'])
        ->name('task.complete');
});
