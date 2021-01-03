<?php

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
    if (Auth::user()) $tasks = (new \App\Repository\TaskRepository())->getRecentTasksOfCurrentUser();
    return view('welcome', compact('tasks'));
})->name('welcome');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');

Route::prefix('task')->group(function (){
    Route::get('/',[\App\Http\Controllers\TaskController::class,'tasksList'])
        ->name('tasks');

    Route::get('/create',[\App\Http\Controllers\TaskController::class,'createTask'])->name('task.create');
    Route::post('/create',[\App\Http\Controllers\TaskController::class,'saveTask'])
        ->name('task.save');

    /**
     * @todo Show one task detail
     */
    Route::get('/{id}/',[\App\Http\Controllers\TaskController::class,'showOneTask'])->name('task.view');

    Route::get('/{id}/delete',[\App\Http\Controllers\TaskController::class, 'deleteTask'])
        ->name('task.delete');
    Route::get('/{id}/edit',[\App\Http\Controllers\TaskController::class,'editTask'])
        ->name('task.edit');
});
