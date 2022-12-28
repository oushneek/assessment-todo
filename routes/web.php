<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\ToDoController;

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

Route::get('/', [CustomAuthController::class, 'index'])->name('login');


Route::get('dashboard', [CustomAuthController::class, 'dashboard'])->name('dashboard');
Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');
Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom');
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');

// To Do List CRUD Routes
Route::get('todos',  [ToDoController::class, 'index'])->name('todo.index');
Route::get('todos/create', [ToDoController::class, 'create'])->name('todo.create');
Route::post('todos/store', [ToDoController::class, 'store'])->name('todo.store');
Route::get('todos/{id}/show', [ToDoController::class, 'show'])->name('todo.show');
Route::get('todos/{id}/edit', [ToDoController::class, 'edit'])->name('todo.edit');
Route::put('todos/{id}/update', [ToDoController::class, 'update'])->name('todo.update');
Route::delete('todos/{id}/delete', [ToDoController::class, 'destroy'])->name('todo.delete');

Route::get('todos/export/', [ToDoController::class, 'export'])->name('todo.export');




