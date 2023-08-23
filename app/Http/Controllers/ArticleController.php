<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Atom;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index() {
        return view('home', ['articles' => Article::all()]);
    }
    public function show($id) {
        $article = Article::find($id);
        return response()->json($article);
    }

    public function searchArticles(Request $request)
    {
        if(isset($request->keywords) && !is_null($request->keywords)) {
            $keyword = $request->input('keywords');
            $atoms = explode(' ', $keyword);

            //todo вероятно можно оптимизировать
            //собираю массив статей, в которых присутствуют ключевые слова
            $atoms = Atom::whereIn('word', $atoms)->get();
            $articles = [];
            foreach ($atoms as $atom) {
                foreach ($atom->articles as $article) {
                    $articles[] = $article;
                }
            }

            //сортирую по полю occurrences
            usort($articles, function ($a, $b) {
                if($a['pivot']['occurrences'] === $b['pivot']['occurrences']) {
                    return 0;
                }
                return ($a['pivot']['occurrences'] > $b['pivot']['occurrences']) ? -1 : 1;
            });

            //при нескольких введенных словах могут быть дубли, но с разными pivot значениями, удалим и
            $uniqueIds = []; //массив уникальных id
            $uniqueArticles = []; //массив уникальных статей
            foreach ($articles as $article) {
                if (!in_array($article['id'], $uniqueIds)) {
                    $uniqueIds[] = $article['id'];
                    $uniqueArticles[] = $article;
                }
            }
            return response()->json($uniqueArticles);
        }
    }
}
