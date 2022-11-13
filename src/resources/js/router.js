import { createWebHistory, createRouter } from 'vue-router';

// import SingleProductView from './components/products/SingleProductView.vue';
// const SingleProductView = () => import('./components/products/SingleProductView.vue');

import ProductsList from './components/ProductsList.vue';
import SingleProduct from './components/products/SingleProduct.vue';
import ProductCreate from './components/products/ProductCreate.vue';
import ProductsCart from './components/ProductsCart.vue'

const router = createRouter({
    history: createWebHistory('/vue-shop'),

    routes: [
        {
            path: '/',
            component: ProductsList,
            name: 'products.list'
        },
        {
            path: '/product/:product',
            component: SingleProduct,
            name: 'product.display'
        },
        {
            path: '/product/create',
            component: ProductCreate,
            name: 'product.create'
        },

        {
            path: '/cart',
            component: ProductsCart,
            name: `cart.show`
        }
    ],
});

export default router;
