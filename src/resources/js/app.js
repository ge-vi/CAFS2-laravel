import './bootstrap';

import {createApp} from 'vue';
// import App from './App.vue';
// import App from './ShopApp.vue';
import App from './VueShop.vue';

import Router from "./router";

const app = createApp(App);

app.use(Router);
app.provide('API_BASE_URL', '/api/v1');
app.provide('API_PROD_URL', '/api/v1/product');
app.provide('API_CATEGORIES_URL', '/api/v1/categories');

app.mount('#app');
