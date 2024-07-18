<?php

use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\NewItemController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [NewItemController::class, 'index']);
Route::get('/news', [NewItemController::class, 'index'])->name('news');
Route::get('/news/comments/{id}', [NewItemController::class, 'comments'])->name('news.comments');
Route::post('/news/{id}/comments', [NewItemController::class, 'newComment'])->name('new.comment');
