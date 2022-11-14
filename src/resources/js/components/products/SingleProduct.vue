<script setup>
import {inject, onBeforeMount, reactive, ref} from 'vue';
import {useRoute, useRouter} from 'vue-router';
import axios from 'axios';
import TemplateTitle from '../partials/TemplateTitle.vue';

const errors = reactive({});
const route = useRoute();
const router = useRouter();
const API_PROD_URL = inject('API_PROD_URL');

const product = ref(null);

onBeforeMount(() => {
    axios
        .get(`${API_PROD_URL}/${route?.params?.product}`)
        .then(resp => {
            product.value = resp.data.data;
            // console.log(resp.data.data);
        })
        .catch(error => {
            errors.message = error.message
            console.error(error.message);
        });
})

function deleteProduct() {
    axios
        .delete(`${API_PROD_URL}/${product.value.id}`)
        .then(resp => {
            console.log(resp);
            if (resp.status === 204) {
                router.push({name: 'products.list'});
            }
        })
        .catch(err => console.error(err))
}

function editProduct() {
    router.push({name: 'product.edit', params: {product: product.value.id}});
}

</script>

<template>
  <template-title :title="route.meta.componentName" />

  <div
    v-if="!errors.message"
    class="row"
  >
    <div class="col">
      <img
        class="img-thumbnail mx-auto d-block"
        src="https://via.placeholder.com/300"
        alt="{{ product?.name }}"
      >
    </div>
    <div class="col">
      <h2>{{ product?.name }}</h2>
      <p>
        Belongs to
        category:
        <br><b>{{ product?.category?.name }}</b>
        <br><b>{{ product?.category?.description }}</b>
      </p>
      <p>Description:<br><span v-html="product?.description" /></p>
      <p>Price:<br><b>{{ product?.price }} €</b></p>
      <p>Available quantity:<br><b>{{ product?.stock }}</b></p>

      <form
        action="#"
        method="post"
        class="row g-3"
      >
        <div class="col-auto">
          <label
            for="add-cart-quantity"
            class="form-control-plaintext"
          >Quantity to purchase:</label>
        </div>
        <div class="col-auto">
          <input
            id="add-cart-quantity"
            name="add-cart-quantity"
            class="form-control"
            type="number"
            value="1"
          >
        </div>
        <div class="col-auto">
          <button class="btn btn-outline-success">
            Add to cart
          </button>
        </div>
      </form>
    </div>

    <div class="row my-5">
      <div class="col">
        <button
          class="btn btn-outline-warning mx-2"
          @click.prevent="editProduct"
        >
          Edit product
        </button>
        <button
          class="btn btn-outline-danger"
          @click.prevent="deleteProduct"
        >
          Delete product
        </button>
      </div>
    </div>
  </div>

  <div
    v-else
    class="row"
  >
    <div
      class="alert alert-warning my-5"
      role="alert"
    >
      Product not found.
    </div>
  </div>
</template>
