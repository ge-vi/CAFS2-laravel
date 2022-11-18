<script setup>
import {onBeforeMount, onMounted, ref} from 'vue';
import {useRoute, useRouter} from 'vue-router';
import {AxiosError} from 'axios';

import {useProductsStore} from '@/stores/products';
import {useCategoriesStore} from '@/stores/categories';

import TemplateTitle from '../partials/TemplateTitle.vue';
import ErrorsAlert from '../partials/ErrorsAlert.vue';

const route = useRoute();
const router = useRouter();

const errors = ref([]);

const productsStore = useProductsStore();
const categoriesStore = useCategoriesStore();

onBeforeMount(() => {

    productsStore.product.id = route.params?.product;

    productsStore
        .load()
        .catch(err => {
            errors.value.push(err.message);
            console.error(err.message);
        });

    categoriesStore
        .fetchCategories()
        .catch(err => {
            errors.value.push(err.message);
            console.error(err);
        });
});

onMounted(() => {
    productsStore.product.isActive = 1;
});

function onProductFormSubmit() {
    productsStore
        .update()
        .then(resp => {
            if (resp.status === 200) {
                router.push({
                    name: 'product.display',
                    params: {product: resp.data.data.id}
                });
            } else {
                errors.value.push(resp.statusText);
            }
        })
        .catch(err => {
            if (err instanceof AxiosError) {
                errors.value.push(err.response.data.message);
            }
            console.error(err);
        })
}
</script>

<template>
  <template-title :title="route.meta.componentName" />

  <h1 class="text-center">
    Edit product
  </h1>

  <errors-alert
    v-if="errors.length > 0"
    :errors="errors"
  />

  <div
    v-else
    class="row"
  >
    <form
      class="col-12 col-lg-6 offset-lg-3"
      @submit.prevent="onProductFormSubmit"
    >
      <div class="mb-3">
        <label
          for="product-name"
          class="form-label"
        >Name</label>
        <input
          id="product-name"
          v-model="productsStore.product.name"
          name="product-name"
          class="form-control"
        >
      </div>

      <div class="mb-3">
        <label
          for="product-description"
          class="form-label"
        >Description</label>
        <textarea
          id="product-description"
          v-model="productsStore.product.description"
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
        <label
          for="product-identifier"
          class="form-label"
        >Identifier</label>
        <input
          id="product-identifier"
          v-model="productsStore.product.identifier"
          name="product-identifier"
          class="form-control"
          placeholder="13 digit length"
        >
      </div>

      <div class="mb-3">
        <label
          for="product-category"
          class="form-label"
        >Category</label>
        <select
          id="product-category"
          v-model="productsStore.product.category.id"
          name="product-category"
          class="form-select"
        >
          <option
            v-for="category in categoriesStore.categories"
            :key="category.id"
            :value="category.id"
          >
            {{ category.name }} ({{ category.id }})
          </option>
        </select>
      </div>

      <div class="mb-3">
        <label
          for="product-price"
          class="form-label"
        >Price</label>
        <input
          id="product-price"
          v-model="productsStore.product.price"
          name="product-price"
          class="form-control"
        >
      </div>

      <div class="mb-3">
        <label
          for="product-stock"
          class="form-label"
        >Stock</label>
        <input
          id="product-stock"
          v-model="productsStore.product.stock"
          type="number"
          name="product-stock"
          class="form-control"
        >
      </div>

      <div class="mb-3">
        <button
          type="submit"
          class="btn btn-outline-success my-3"
        >
          Save product
        </button>
      </div>
    </form>
  </div>
</template>
