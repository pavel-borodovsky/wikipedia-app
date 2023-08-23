import './bootstrap';
import { createApp } from 'vue/dist/vue.esm-bundler';
import SearchVue from "./components/SearchVue.vue";
const app = createApp({
    components: {
        'search-vue' : SearchVue,
    }
});

app.mount('#app');
