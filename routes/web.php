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

Route::get('/', function () {
    $articles = Article::latest()->get();
    return view('articles', compact('articles'));
});

Route::post('/import', [WikipediaController::class, 'importArticles'])->name('import');
Route::post('/search', [WikipediaController::class, 'searchArticles'])->name('search');
Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('article.show');
