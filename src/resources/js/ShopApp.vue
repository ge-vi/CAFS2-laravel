<template>
  <h1 class="text-center my-3">
    Hello Vue Shop
  </h1>

  <div class="card my-3">
    <div class="card-body">
      <div class="form-check">
        <input
          id="inactive-products"
          v-model="inactiveProducts"
          class="form-check-input"
          type="checkbox"
        >
        <label
          class="form-check-label"
          for="inactive-products"
        >Show inactive products</label>
      </div>
    </div>

    <div class="card-body">
      <floating-search
        v-model="searchInput"
        search-label="Search for product"
      />
    </div>

    <div class="card-body">
      <label for="products-category">Filter by product category</label>
      <select
        id="products-category"
        v-model="selectedCategory"
        class="form-select"
      >
        <option value="">
          all categories
        </option>
        <option
          v-for="category in categories"
          :key="`ctg-${category.id}`"
          :value="category.id"
        >
          {{ category.name }}
        </option>
      </select>
    </div>
  </div>

  <product-list
    v-if="products.length > 0"
    :products="products"
  />

  <h3
    v-else
    class="text-center"
  >
    No products found
  </h3>
</template>

<script setup>
import {onBeforeMount, ref, watch} from "vue";
import axios from "axios";

import ProductList from './components/ProductsList.vue';
import FloatingSearch from "./components/FloatingSearch.vue";

const products = ref([]);
const inactiveProducts = ref(false);

const categories = ref([]);
const selectedCategory = ref('');

const searchInput = ref('');

const BASE_URL = '/api/v1';
const ACTIVE_PRODUCTS_URL = `${BASE_URL}/products/active`;
const INACTIVE_PRODUCTS_URL = `${BASE_URL}/products/inactive`;
const CATEGORIES_URL = `${BASE_URL}/categories`;

onBeforeMount(() => {
    getItems(ACTIVE_PRODUCTS_URL, products);
    getItems(CATEGORIES_URL, categories);
})

watch([selectedCategory, inactiveProducts], function () {
    if (inactiveProducts.value) {
        getItems(`${INACTIVE_PRODUCTS_URL}/${selectedCategory.value}`, products);
    } else {
        getItems(`${ACTIVE_PRODUCTS_URL}/${selectedCategory.value}`, products);
    }
})

watch(searchInput, function () {
    searchItems(searchInput.value);
});

function getItems(url, refStorage) {
    axios
        .get(url)
        .then(response => refStorage['value'] = response.data.data)
        .catch(error => console.error(error))
}

function searchItems(searchString) {
    searchString = searchString.trim();
    axios
        .get(`${BASE_URL}/search?search=${searchString}`)
        .then(response => products.value = response.data.data)
        .catch(error => console.error(error))
}

</script>
