<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });
Route::get('/', [HomeController::class, "index"])->name('dashboard');

Route::prefix('/student')->group(function(){
Route::get('/', [StudentController::class, "index"])->name('student');
Route::post('/store', [StudentController::class, "store"])->name('student.store');
Route::post('/{student_id}/update', [StudentController::class, "update"])->name('student.update');
Route::get('/{student_id}/delete', [StudentController::class, "delete"])->name('student.delete');
// Route::get('/{student_id}/get', [StudentController::class, "get"])->name('student.get');
Route::get('/{student_id}/status', [StudentController::class, "status"])->name('student.status');
Route::get('/{student_id}/edit', [StudentController::class, "edit"])->name('student.edit');
Route::get('/list', [StudentController::class, "list"])->name('student.list');



// Route::get('/{task_id}/sub', [TodoController::class, "sub"])->name('todo.sub');
// Route::post('/sub/store', [TodoController::class, "subStore"])->name('todo.sub.store');
});
require __DIR__.'/auth.php';
