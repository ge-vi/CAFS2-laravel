<script setup>

import {inject, onBeforeMount, onMounted, reactive, ref} from 'vue';
import {useRoute, useRouter} from 'vue-router';
import axios, {AxiosError} from 'axios';
import TemplateTitle from '../partials/TemplateTitle.vue';
import ErrorsAlert from '../partials/ErrorsAlert.vue';

const route = useRoute();
const router = useRouter();

const API_PROD_URL = inject('API_PROD_URL');
const API_CATEGORIES_URL = inject('API_CATEGORIES_URL');

const errors = ref([]);

const product = reactive({
    id: null,
    name: null,
    description: null,
    identifier: null,
    category: null,
    price: null,
    stock: null,
    isActive: 1
});

const categories = ref([]);

onBeforeMount(() => {
    fetchCategories();
});

onMounted(async () => {
    try {
        // get product data
        const response = await fetchProduct(route.params.product);
        const productRaw = response.data.data;

        product.id = productRaw.id;
        product.name = productRaw.name;
        product.description = productRaw.description;
        product.identifier = productRaw.identifier;
        product.price = productRaw.price;
        product.stock = productRaw.stock;

        // make form option selected
        product.category = productRaw.category.id;

    } catch (err) {
        errors.value.push(err.message);
    }
});

async function fetchProduct(id) {
    return await axios.get(`${API_PROD_URL}/${id}`);
}

function fetchCategories() {
    axios
        .get(`${API_CATEGORIES_URL}`)
        .then(resp => {
            categories.value = resp.data.data;
        })
        .catch(err => {
            errors.value.push(err.message);
        });
}

function submitForm() {
    axios
        .patch(
            `${API_PROD_URL}/${product.id}`,
            {
                id: product.id,
                is_active: product.isActive,
                category_id: product.category,
                stock: product.stock,
                name: product.name,
                description: product.description,
                identifier: product.identifier,
                price: product.price
            }
        )
        .then(resp => {
            if (resp.status === 200) {
                router.push({name: 'product.display', params: {product: resp.data.data.id}});
            } else {
                errors.value.push(resp.statusText);
            }
        })
        .catch(
            err => {
                if (err instanceof AxiosError) {
                    errors.value.push(err.response.data.message);
                }
                console.error(err);
            }
        )
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
      class="col-6 offset-3"
      @submit.prevent="submitForm"
    >
      <div class="mb-3">
        <label
          for="product-name"
          class="form-label"
        >Name</label>
        <input
          id="product-name"
          v-model="product.name"
          name="product-name"
          class="form-control"
        >
      </div>

      <div class="mb-3">
        <p class="mb-0">
          Description
        </p>
        <QuillEditor
          v-model:content="product.description"
          content-type="html"
          theme="snow"
          toolbar="minimal"
        />
      </div>

      <div class="mb-3">
        <label
          for="product-identifier"
          class="form-label"
        >Identifier</label>
        <input
          id="product-identifier"
          v-model="product.identifier"
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
        <label
          for="product-price"
          class="form-label"
        >Price</label>
        <input
          id="product-price"
          v-model="product.price"
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
          v-model="product.stock"
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
