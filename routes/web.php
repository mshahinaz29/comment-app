<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;
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
//     return view('welcome');
// });
Route::get('/', [CommentController::class, 'index'])->name('index');
Route::get('comments/fetch', [CommentController::class, 'fetch'])->name('fetch');
Route::resource('/comments', CommentController::class);