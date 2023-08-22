<!DOCTYPE html>
<html>
<body>
<h1>Статьи</h1>
<table>
    <thead>
    <th>Заголовок</th>
    <th>Операции</th>
    </thead>
    <tbody>
    @foreach($articles as $article)
        <tr>
            <td>{{ $article->title }}</td>
            <td>
                <a href="#" onclick="showContent({{ $article->id }})">Показать содержимое</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<div id="content_container"></div>

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

<script>
    function showContent(articleId) {
        var container = document.getElementById('content_container');

        var xhr = new XMLHttpRequest();
        xhr.open('GET', '/articles/' + articleId);
        xhr.onload = function() {
            if (xhr.status === 200) {
                console.log(xhr);
                container.innerHTML = xhr.responseText;
            }
        };
        xhr.send();
    }
</script>
</body>
</html>
