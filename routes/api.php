<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoListController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('todo-list',[TodoListController::class, 'index'])->name('todo-list.list');
Route::post('todo-list',[TodoListController::class, 'store'])->name('todo-list.store');
Route::get('todo-list/{id}',[TodoListController::class, 'show'])->name('todo-list.show');
