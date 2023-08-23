<!DOCTYPE html>
<html>
<head>
    <title>Wikipedia-app</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<a href="#" id="import">Импорт</a>
<a href="#" id="search">Поиск</a>
<!-- Контент вкладок -->
<div id="import-tab" style="display: block">
    <div>
        <h2>Импорт статьи</h2>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('import') }}" method="POST">
            @csrf
            <input type="text" name="keyword" placeholder="Ключевое слово">
            <button type="submit">Скопировать</button>
        </form>

    @if(count($articles) > 0)
        <table>
            <thead>
            <th>Заголовок</th>
            <th>Ссылка</th>
            <th>Кол-во слов</th>
            </thead>
            <tbody>
            @foreach($articles as $article)
                <tr>
                    <td>{{ $article->title }}</td>
                    <td>
                        <a href="http://ru.wikipedia.org/wiki/{{$article->title}}">http://ru.wikipedia.org/wiki/{{$article->title}}</a>
                    </td>
                    <td>{{ count($article->atoms) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
    </div>
</div>
<div id="search-tab" style="display: none">
    <div id="app">
        <search-vue></search-vue>
    </div>
</div>
<script>
    // При загрузке страницы
    document.addEventListener("DOMContentLoaded", function () {
        // Установить обработчики событий на вкладки

        // Обработчик вкладки импорта
        document.getElementById("import").addEventListener("click", function () {
            // Переключить видимость вкладок
            const importTab = document.getElementById('import-tab');
            const searchTab = document.getElementById('search-tab');
            importTab.style.display = 'block';
            searchTab.style.display = 'none';
        });

        // Обработчик вкладки поиска
        document.getElementById("search").addEventListener("click", function () {
            const importTab = document.getElementById('import-tab');
            const searchTab = document.getElementById('search-tab');
            importTab.style.display = 'none';
            searchTab.style.display = 'block';
        });
    });
</script>
</body>
</html>
