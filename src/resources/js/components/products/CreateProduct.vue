<script setup>
import {inject, onMounted, reactive, ref} from 'vue';
import axios, {AxiosError} from 'axios';
import {useRouter, useRoute} from 'vue-router';
import TemplateTitle from '../partials/TemplateTitle.vue';

const API_PROD_URL = inject('API_PROD_URL');
const API_CATEGORIES_URL = inject('API_CATEGORIES_URL');

const router = useRouter();
const route = useRoute();

const errors = ref([]);
const categories = ref([]);

const product = reactive({
    name: null,
    description: null,
    category: null,
    price: null,
    stock: null,
    identifier: null,
    is_active: 1
});


onMounted(() => {
    fetchCategories();
});

function fetchCategories() {
    axios
        .get(API_CATEGORIES_URL)
        .then(resp => categories.value = resp.data.data)
        .catch(err => {
            errors.value.push(err.message);
            console.error(err);
        });
}

function submitForm() {
    console.log(product);

    axios
        .post(
            API_PROD_URL,
            product
        )
        .then(
            resp => {
                console.log('resp: ', resp);
                if (resp.status === 201) {
                    // open new product page
                    router.push({name: 'product.display', params: {product: resp.data.id}})
                }
            }
        )
        .catch(
            err => {
                if (err instanceof AxiosError) {
                    errors.value.push(err.response.data.message);
                }
                console.error(err)
            }
        )
}
</script>

<template>
  <template-title :title="route.meta.componentName" />

  <h1 class="text-center">
    Create new product
  </h1>

  <div class="row">
    <div
      v-if="errors.length > 0"
      class="alert alert-danger"
    >
      <ul class="m-0">
        <li
          v-for="error in errors"
          :key="`err-${error.message}`"
        >
          {{ error }}
        </li>
      </ul>
    </div>

    <form
      class="col-6 offset-3"
      @submit.prevent="submitForm"
    >
      <div class="mb-3">
        <label for="product-name">Name</label>
        <input
          id="product-name"
          v-model="product.name"
          name="product-name"
          class="form-control"
        >
      </div>

      <div class="mb-3">
        <label for="product-description">Description</label>
        <input
          id="product-description"
          v-model="product.description"
          name="product-description"
          class="form-control"
        >
      </div>

      <div class="mb-3">
        <label for="product-identifier">Identifier</label>
        <input
          id="product-identifier"
          v-model="product.identifier"
          name="product-identifier"
          class="form-control"
          placeholder="13 digit length"
        >
      </div>

      <div class="mb-3">
        <label for="product-category">Category</label>
        <select
          id="product-category"
          v-model="product.category"
          name="product-category"
          class="form-select"
        >
          <option
            v-for="category in categories"
            :key="`${category.id}_${category.name}`"
            :value="category.id"
          >
            {{ category.name }} ({{ category.id }})
          </option>
        </select>
      </div>

      <div class="mb-3">
        <label for="product-price">Price</label>
        <input
          id="product-price"
          v-model="product.price"
          name="product-price"
          class="form-control"
        >
      </div>

      <div class="mb-3">
        <label for="product-stock">Stock</label>
        <input
          id="product-stock"
          v-model="product.stock"
          type="number"
          name="product-stock"
          class="form-control"
        >
      </div>

      <button
        type="submit"
        class="btn btn-outline-success my-3"
      >
        Create new product
      </button>
    </form>
  </div>
</template>
