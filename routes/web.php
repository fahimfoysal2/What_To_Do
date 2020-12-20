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
    $tasks = array(
        array(
            'id' => 1,
            'title' => "My task",
            'description' => "My task Description"
        ),
        array(
            'id' => 2,
            'title' => "My task 2",
            'description' => "My 2nd task Description"
        ),
        array(
            'id' => 3,
            'title' => "My task 3",
            'description' => "My 3rd task Description"
        )
    );
    // return view('welcome', ["tasks"=>$tasks]);
    return view('welcome', compact('tasks'));
});

// Route::get('/login', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
