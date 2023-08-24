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
    <div id="app2">
        <import-vue></import-vue>
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
