<template>
  <h2 class="text-center my-3">
    Product List from <code>ProductList.vue</code>
  </h2>

  <div
    v-if="products.length"
    class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 mb-3 text-center"
  >
    <product-card
      v-for="(product, index) in products"
      :key="`prd-${index}`"
      :product="product"
    />
  </div>

  <div
    v-else
    class="alert alert-warning"
    role="alert"
  >
    No products found.
  </div>
</template>

<script setup>
import ProductCard from './ProductCard.vue';


import {onBeforeMount, ref} from "vue";
import axios from "axios";

const BASE_URL = '/api/v1';
const ACTIVE_PRODUCTS_URL = `${BASE_URL}/products/active`;

const products = ref([]);


onBeforeMount(() => {
    getItems(ACTIVE_PRODUCTS_URL, products);
})

function getItems(url, refStorage) {
    axios
        .get(url)
        .then(response => refStorage['value'] = response.data.data)
        .catch(error => console.error(error))
}



// defineProps({
//     products: {
//         type: Array,
//         default: null
//     }
// })
</script>
