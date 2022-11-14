<template>
  <h2>Interpolation</h2>

  <p>du + du * du - du = {{ 2 + 2 * 2 - 2 }}</p>

  <hr>

  <!-- href not working-->
  <a href="{{ url }}">{{ url }}</a><br>

  <!-- use built-in directive `v-bind` -->
  <a :href="url">{{ url }}</a><br>

  <!-- shorthand syntax for `v-bind` -->
  <a :href="url">{{ url }}</a><br>

  <hr>

  <!-- https://vuejs.org/guide/introduction.html#api-styles -->
  <p>Click button to increment count</p>
  <button
    class="btn btn-success"
    @click="incrementCount"
  >
    Count: {{ count }}
  </button>

  <hr>

  <p>Counter: {{ state.counter }}</p>
  <button
    class="btn btn-dark"
    @click="addOne"
  >
    Increment
  </button>
  <button
    class="btn btn-outline-dark"
    @click="subtractOne"
  >
    Decrement
  </button>

  <hr>

  <!-- :value="inputValue" should be used, if not: empty input is displayed -->
  <input
    :value="inputValue"
    @input="setSomeText"
  >
  <p>{{ inputValue }}</p>

  <hr>

  <!-- v-model -->
  <input v-model="inputValue2">
  <p>{{ inputValue2 }}</p>

  <hr>

  <h2>List Rendering with <code>v-for</code></h2>

  <ul>
    <li
      v-for="item in people"
      :key="`p-${item}`"
    >
      {{ item }}
    </li>
  </ul>

  <hr>

  <h2>Product cards component with directive <code>v-for</code></h2>

  <product-card
    v-for="product in products"
    :key="product.id"
    :product="product"
  />

  <hr>

  <!-- ProductList component with reused ProductCard -->
  <product-list :products="products" />
</template>

<script setup>
import ProductCard from './components/ProductCard.vue';
import ProductList from './components/ListProducts.vue';

import {reactive, ref} from "vue";

const url = 'https://www.google.com';

const count = ref(0);

function incrementCount() {
    count.value++;
}

// `reactive` - for non-primitive values
// objects with many values
const state = reactive({
    counter: 0
});

function addOne() {
    state.counter++;
}
function subtractOne() {
    state.counter--;
}

// `ref` - for primitive value
// Takes an inner value and returns a reactive and mutable ref object,
// which has a single property `.value` that points to the inner value.
// https://vuejs.org/api/reactivity-core.html#ref
const inputValue = ref('Initial value');

function setSomeText(evt) {
    inputValue.value = evt.target.value;
}

const inputValue2 = ref();

// foreach

const people = ref([
    'Foo',
    'Bar',
    'Baz'
]);

// components

const products = reactive([
    {
        id: 1,
        productName: "Product 1",
        categoryName: "Product category 1",
        productDescription: "Product description 1",
        productPrice: 123.4,
        productIsActive: true
    },
    {
        id: 2,
        productName: "Product 2",
        categoryName: "Product category 2",
        productDescription: "Product description 2",
        productPrice: 234.56,
        productIsActive: true
    }
]);

</script>
