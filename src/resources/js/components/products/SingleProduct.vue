<template>
  <div
    v-if="!errors.message"
    class="row"
  >
    <div class="col">
      <img
        class="img-thumbnail mx-auto d-block"
        src="https://via.placeholder.com/300"
        alt="{{ product.name }}"
      >
    </div>
    <div class="col">
      <h2>{{ product.name }}</h2>
      <p>
        Belongs to
        category:
        <br><b>{{ product.category.name }}</b>
        <br><b>{{ product.category.description }}</b>
      </p>
      <p>Description:<br><b>{{ product.description }}</b></p>
      <p>Price:<br><b>{{ formattedPrice }}</b></p>
      <p>Available quantity:<br><b>{{ product.stock }}</b></p>

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

<script setup>
import {computed, inject, onBeforeMount, reactive, ref} from 'vue';
import {useRoute} from 'vue-router';
import axios from 'axios';

const errors = reactive({});
const route = useRoute();
const API_PROD_URL = inject('API_PROD_URL');

const product = ref({});
const formattedPrice = ref(null);

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

    formattedPrice.value = computed(() => {
        return `${Number.parseFloat(product.value.price).toFixed(2)}  €`;
    });
})




// eslint-disable-next-line no-unused-vars
const productMock = {
    name: 'product name',
    description: 'product description',
    price: 123.4,
    stock: 10,
    category: {
        name: 'category name',
        description: 'category description'
    }
}

</script>
