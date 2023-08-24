import './bootstrap';
import { createApp } from 'vue/dist/vue.esm-bundler';
import SearchVue from "./components/SearchVue.vue";
import Import from "./components/Import.vue";
const app = createApp({
    components: {
        'search-vue' : SearchVue,
    }
});
const app2 = createApp({
    components: {
        'import-vue' : Import
    }
});
app.mount('#app');
app2.mount('#app2');
