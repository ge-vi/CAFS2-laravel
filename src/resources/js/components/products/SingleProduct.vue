<script setup>
import {onBeforeMount, ref} from 'vue';
import {useRoute, useRouter} from 'vue-router';

import TemplateTitle from '../partials/TemplateTitle.vue';

import {useProductsStore} from '@/stores/products';

const errors = ref([]);

const route = useRoute();
const router = useRouter();

const productsStore = useProductsStore();

onBeforeMount(() => {

    productsStore.product.id = route?.params?.product;

    productsStore
        .load()
        .catch(err => {
            errors.value.push(err.message);
            console.error(err.message);
        });
})

function deleteProduct() {
    productsStore
        .delete()
        .then(resp => {
            if (resp.status === 204) {
                router.push({name: 'products.list'});
            }
        })
        .catch(err => {
            errors.value.push(err.message);
            console.error(err);
        });
}

function editProduct() {
    router
        .push({
            name: 'product.edit',
            params: {product: productsStore.product.id}
        })
        .catch(err => {
            errors.value.push(err.message);
            console.error(err);
        });
}
</script>

<template>
  <template-title :title="route.meta.componentName" />

  <div
    v-if="!errors.length > 0"
    class="row"
  >
    <div class="col-sm-12 mb-sm-5 col-lg-6">
      <img
        class="img-thumbnail mx-auto d-block"
        src="https://via.placeholder.com/300"
        alt="{{ productsStore.product?.name }}"
      >
    </div>
    <div class="col-sm-12 col-lg-6">
      <h2>{{ productsStore.product?.name }}</h2>
      <p>
        Belongs to
        category:
        <br><b>{{ productsStore.product?.category?.name }}</b>
        <br><b>{{ productsStore.product?.category?.description }}</b>
      </p>
      <p>Description:<br><span v-html="productsStore.product?.description" /></p>
      <p>Price:<br><b>{{ productsStore.product?.price }} €</b></p>
      <p>Available quantity:<br><b>{{ productsStore.product?.stock }}</b></p>

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
