import './bootstrap';
import '../sass/app.scss'
import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';
import { VueClipboard } from '@soerenmartius/vue3-clipboard';

// Import components
import App from './components/App.vue';
import Register from './components/Register.vue';
import Home from './components/Home.vue';
import { Form } from 'vform'
window.Form = Form;

const router = createRouter({
    history: createWebHistory(),
    routes: [
        { path: '/', component: Register },
        { path: '/:personal_link', component: Home },
    ]
});
const app = createApp(App);
app.use(router);
app.use(VueClipboard);
app.mount('#app');
