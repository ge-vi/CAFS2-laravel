<template>

    <h2>Product List from <code>ProductList.vue</code></h2>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 mb-3 text-center">
        <product-card v-for="product in products" :product="product"></product-card>
    </div>
</template>

<script setup>
import ProductCard from './ProductCard.vue';

defineProps([
    'products'
])
</script>
