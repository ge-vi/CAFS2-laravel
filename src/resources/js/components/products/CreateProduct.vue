<script setup>
import {onMounted, ref} from 'vue';
import {useRoute, useRouter} from 'vue-router';
import {AxiosError} from "axios";

import TemplateTitle from '../partials/TemplateTitle.vue';

import {useCategoriesStore} from '@/stores/categories';
import {useProductsStore} from '@/stores/products';

const errors = ref([]);

const router = useRouter();
const route = useRoute();

const categoriesStore = useCategoriesStore();
const productsStore = useProductsStore();

onMounted(() => {
    productsStore.initProduct();

    categoriesStore
        .fetchCategories()
        .catch(err => {
            errors.value.push(err.message);
            console.error(err);
        });
});

function onProductFormSubmit() {
    productsStore
        .saveNew()
        .then(() => {
            router.push({
                name: 'product.display',
                params: {product: productsStore.product.id}
            });
        })
        .catch(err => {
                if (err instanceof AxiosError) {
                    errors.value.push(err.response.data.message);
                }
                console.error(err);
            }
        );
}
</script>

<template>
  <template-title :title="route.meta.componentName" />

  <h1 class="text-center">
    Create new product
  </h1>

  <div
    v-if="errors.length > 0"
    class="row"
  >
    <div class="alert alert-danger">
      <ul class="m-0">
        <li
          v-for="error in errors"
          :key="`err-${error.message}`"
        >
          {{ error }}
        </li>
      </ul>
    </div>
  </div>

  <div class="row">
    <form
      class="col-6 offset-3"
      @submit.prevent="onProductFormSubmit"
    >
      <div class="mb-3">
        <label for="product-name">Name</label>
        <input
          id="product-name"
          v-model.trim="productsStore.product.name"
          name="product-name"
          class="form-control"
        >
      </div>

      <div class="mb-3">
        <label for="product-description">Description</label>
        <textarea
          id="product-description"
          v-model.trim="productsStore.product.description"
          name="product-description"
          class="form-control"
          rows="10"
        />
        <div
          class="form-text"
        >
          HTML tags supported in this field.
        </div>
      </div>

      <div class="mb-3">
        <label for="product-identifier">Identifier</label>
        <input
          id="product-identifier"
          v-model.trim="productsStore.product.identifier"
          name="product-identifier"
          class="form-control"
          placeholder="13 digit length"
        >
      </div>

      <div class="mb-3">
        <label for="product-category">Category</label>
        <select
          id="product-category"
          v-model="productsStore.product.category"
          name="product-category"
          class="form-select"
        >
          <option
            v-for="category in categoriesStore.categories"
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
          v-model.trim="productsStore.product.price"
          name="product-price"
          class="form-control"
        >
      </div>

      <div class="mb-3">
        <label for="product-stock">Stock</label>
        <input
          id="product-stock"
          v-model.trim="productsStore.product.stock"
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
