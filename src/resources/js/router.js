import { createWebHistory, createRouter } from 'vue-router';

import ListProducts from './components/ListProducts.vue';

// https://router.vuejs.org/guide/advanced/lazy-loading.html
const SingleProduct = () => import('./components/products/SingleProduct.vue');
const EditProduct = () => import('./components/products/EditProduct.vue');
const CreateProduct = () => import('./components/products/CreateProduct.vue');
const ProductsCart = () => import('./components/ProductsCart.vue');

const router = createRouter({
    history: createWebHistory('/vue-shop'),

    routes: [
        {
            path: '/',
            component: ListProducts,
            name: 'products.list',
            meta: {componentName: 'ListProducts.vue'}
        },
        {
            path: '/product/:product',
            component: SingleProduct,
            name: 'product.display',
            meta: {componentName: 'SingleProduct.vue'}
        },
        {
            path: '/product/:product/edit',
            component: EditProduct,
            name: 'product.edit',
            meta: {componentName: 'EditProduct.vue'}
        },
        {
            path: '/product/create',
            component: CreateProduct,
            name: 'product.create',
            meta: {componentName: 'CreateProduct.vue'}
        },
        {
            path: '/cart',
            component: ProductsCart,
            name: `cart.show`
        }
    ],
});

export default router;
