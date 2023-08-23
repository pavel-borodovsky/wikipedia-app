<?php

use App\Http\Controllers\ArticleController;
use App\Models\Article;
use App\Http\Controllers\WikipediaController;
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

Route::get('/', [ArticleController::class, 'index']);
Route::post('/import', [WikipediaController::class, 'importArticles'])->name('import');
Route::get('/search', [ArticleController::class, 'searchArticles'])->name('search');
Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('article.show');
