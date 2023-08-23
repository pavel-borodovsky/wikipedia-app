<template>
    <div>
        <input type="text" v-model="keywords">
        <button @click="searchArticles()" type="submit">Найти</button>
        <ul>
            <li v-for="article in articles" :key="article.id" @click="showArticle(article.id)">
                {{ article.title }}
            </li>
        </ul>
        <div v-if="selectedArticle">
            <h1>{{ selectedArticle.title }}</h1>
            <p>{{ selectedArticle.content }}</p>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            keywords: '',
            selectedArticle: [],
            articles: []
        };
    },
    methods: {
        searchArticles() {
            axios.get('/search', { params: { keywords: this.keywords } })
                .then(response => this.articles = response.data)
                .catch(error => {});
        },
        showArticle(articleId) {
            axios.get('/articles/' + articleId)
                .then(response => this.selectedArticle = response.data)
                .catch(error => {});
        }
    }
}
</script>
