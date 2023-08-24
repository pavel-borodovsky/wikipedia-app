<template>
    <div>
        <form @submit.prevent="importData">
            <input type="text" v-model="keyword" placeholder="Ключевое слово">
            <button type="submit">Скопировать</button>
        </form>

        <table v-if="articles.length > 0">
            <thead>
            <th>Заголовок</th>
            <th>Ссылка</th>
            </thead>
            <tbody>
            <tr v-for="article in articles" :key="article.id">
                <td>{{ article.title }}</td>
                <td>
                    <a :href="article.link" target="_blank">{{ article.title }}</a>
                </td>
            </tr>

            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    data() {
        return {
            keyword: '',
            articles: []
        };
    },
    methods: {
        importData() {
            axios.post('/import', {keyword: this.keyword})
                .then(response => {
                    console.log(response.data.message)
                    this.getArticles();
                })
                .catch(error => {
                    console.log(error);
                });
        },
        getArticles() {
            axios.get('/articles')
                .then(response => {
                    this.articles = response.data;

                })
                .catch(error => {
                    console.log(error);
                });
        }
    },
    mounted() {
        this.getArticles();
    }
};
</script>
