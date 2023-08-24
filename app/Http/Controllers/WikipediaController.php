<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Atom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WikipediaController extends Controller
{
    public function importArticles(Request $request)
    {
        $keyword = $request->input('keyword');
        /**
         * метод query https://ru.wikipedia.org/w/api.php?action=help&modules=query
         * параметр list=search https://ru.wikipedia.org/w/api.php?action=help&modules=query%2Bsearch
         * метод по умолчанию возвращает 10 подходящих статей
         */
        $response = Http::get('https://ru.wikipedia.org/w/api.php?action=query&format=json&list=search&srsearch=' . $keyword);
        $data = $response->json();

        if (isset($data['query']['search'])) {
            foreach($data['query']['search'] as $article) {
                //берем заголовок статьи
                $articleTitle = $article['title'];

                //для извлечения plain text используем в апи методе query параметр prop=extracts - https://ru.wikipedia.org/w/api.php?action=help&modules=query%2Bextracts
                //параметр explaintext=true возвращает plain text вместо html
                $articleResponse = Http::get('https://ru.wikipedia.org/w/api.php?action=query&format=json&prop=extracts&explaintext=true&titles=' . $articleTitle.'&exsectionformat=plain')->json();

                $articleContent = $articleResponse['query']['pages'][array_keys($articleResponse['query']['pages'])[0]]['extract'];
                $articleContent = strip_tags($articleContent); // удаление тегов

                //добавление статьи в базу
                $article = new Article();
                $article->title = $articleTitle;
                $article->content = $articleContent;
                $article->save();

                //делим статью на слова-атомы
                $atoms = $this->extractAtoms($articleContent);
                $atomCount = array_count_values($atoms); //одновременно подсчитываем кол-во повторений слов и убираем лишние

                foreach ($atomCount as $atom => $occurrences) {
                    $atomModel = Atom::create(['word' => $atom]); //добавляем слово в базу
                    $article->atoms()->attach($atomModel, ['occurrences' => $occurrences]); //добавляем свяь m2m с дополнительным полем кол-ва вхождений
                }
            }
            return response()->json(['message' => 'Импорт завершен']);

        }

        return $response->json('message', 'Статья не найдена.');
    }

    private function extractAtoms($content)
    {
        $content = preg_replace('/[^\p{L}\p{N}]+/u', ' ', $content); // удаление знаков препинания
        $content = mb_strtolower($content); // преобразование в нижний регистр

        return explode(' ', $content);
    }
}
