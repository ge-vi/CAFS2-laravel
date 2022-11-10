<template>
  <h2 class="text-center my-3">
    Product List from <code>ProductList.vue</code>
  </h2>

  <div
    v-if="products.length > 0"
    class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 mb-3 text-center"
  >
    <product-card
      v-for="(product, index) in products"
      :key="`prd-${index}`"
      :product="product"
    />
  </div>
</template>

<script setup>
import ProductCard from './ProductCard.vue';

defineProps({
    products: {
        type: Array,
        default: null
    }
})
</script>
