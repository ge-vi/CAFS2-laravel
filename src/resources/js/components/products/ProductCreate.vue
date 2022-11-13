<template>
  <p class="text-center">
    <code>ProductCreate.vue</code>
  </p>

  <h1 class="text-center">
    Create new product
  </h1>

  <div class="row">
    <div
      v-if="errors.length > 0"
      class="alert alert-danger"
    >
      <ul class="m-0">
        <!-- TODO display validation errors -->
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
      <label for="product-name">Name</label>
      <input
        id="product-name"
        v-model="form.productName"
        name="product-name"
        class="form-control"
      >

      <label for="product-description">Description</label>
      <input
        id="product-description"
        v-model="form.productDescription"
        name="product-description"
        class="form-control"
      >

      <label for="product-identifier">Identifier</label>
      <input
        id="product-identifier"
        v-model="form.productIdentifier"
        name="product-identifier"
        class="form-control"
        placeholder="13 digit length"
      >


      <label for="product-category">Category</label>
      <select
        id="product-category"
        v-model="form.productCategory"
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

      <label for="product-price">Price</label>
      <input
        id="product-price"
        v-model="form.productPrice"
        name="product-price"
        class="form-control"
      >

      <label for="product-stock">Stock</label>
      <input
        id="product-stock"
        v-model="form.productStock"
        type="number"
        name="product-stock"
        class="form-control"
      >

      <button
        type="submit"
        class="btn btn-outline-success my-3"
      >
        Create new product
      </button>
    </form>
  </div>
</template>

<script setup>

import {inject, onMounted, reactive, ref} from "vue";
import axios, {AxiosError} from "axios";
import {useRouter} from "vue-router";

const API_PROD_URL = inject('API_PROD_URL');
const API_CATEGORIES_URL = inject('API_CATEGORIES_URL');

const router = useRouter();

const errors = ref([]);
const categories = ref([]);

const form = reactive({
    productName: null,
    productDescription: null,
    productCategory: null,
    productPrice: null,
    productStock: null,
    productIdentifier: null,
    productIsActive: true
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
    console.log(form);

    axios
        .post(
            API_PROD_URL,
            form
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
