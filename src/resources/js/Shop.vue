<template>

    <h1 class="text-center my-3">Hello Vue Shop</h1>

    <div class="card my-3">

        <div class="card-body">
            <div class="form-check">
                <input
                    v-model="inactiveProducts"
                    class="form-check-input"
                    type="checkbox"
                    id="inactive-products"
                >
                <label class="form-check-label" for="inactive-products">Show inactive products</label>
            </div>
        </div>

        <div class="card-body">
            <label for="products-category">Filter by product category</label>
            <select
                v-model="selectedCategory"
                class="form-select"
                id="products-category"
            >
                <option value="">all categories</option>
                <option v-for="category in categories" :value="category.id">{{ category.name }}</option>
            </select>
        </div>
    </div>

    <div v-if="products.length > 0" class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 mb-3 text-center">
        <div
            class="col"
            :data-product-id="product.id" v-for="product in products"
        >
            <div class="card mb-4 rounded-3 shadow-sm">
                <div class="card-header py-3">
                    <p class="my-0 fw-bolder">{{ product.name }}</p>
                </div>
                <div class="card-body">
                    <p>{{ product.description }}</p>
                    <p>Price: {{
                            new Intl.NumberFormat('lt-lt', {
                                style: 'currency',
                                currency: 'EUR'
                            }).format(product.price)
                        }}</p>
                </div>
                <div class="card-footer" v-if="!product.is_active">
                    <p class="text-muted mb-0">Product is not available anymore</p>
                </div>
                <div class="card-footer" v-else>

                    <!-- {{ route('products.show', $productId) }} -->
                    <a
                        :href="`/product/${product.id}`"
                        type="button"
                        class="w-100 btn btn-lg btn-outline-success"
                    >view product details</a>
                </div>
            </div>
        </div>
    </div>
    <h3 v-else>No products found</h3>
</template>

<script setup>
import {onBeforeMount, ref, watch} from "vue";
import axios from "axios";

const products = ref([]);
const inactiveProducts = ref(false);

const categories = ref([]);
const selectedCategory = ref('');

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

function getItems(url, refStorage) {
    axios
        .get(url)
        .then(response => refStorage['value'] = response.data.data)
        .catch(error => console.error(error))
}

</script>
