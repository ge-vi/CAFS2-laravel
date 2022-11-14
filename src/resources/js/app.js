import './bootstrap';

/*
https://getbootstrap.com/docs/5.2/getting-started/vite/
Import all of Bootstrap's JS
 */
import * as bootstrap from 'bootstrap'; // eslint-disable-line no-unused-vars

import {createApp} from 'vue';

import { QuillEditor } from '@vueup/vue-quill';
import '@vueup/vue-quill/dist/vue-quill.snow.css';

// import App from './App.vue';
// import App from './ShopApp.vue';
import App from './VueShop.vue';

import Router from './router';

const app = createApp(App);

app.use(Router);

app.provide('API_BASE_URL', '/api/v1');
app.provide('API_PROD_URL', '/api/v1/product');
app.provide('API_CATEGORIES_URL', '/api/v1/categories');

app.component('QuillEditor', QuillEditor)

app.mount('#app');
