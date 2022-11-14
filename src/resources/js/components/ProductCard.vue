<template>
  <div
    :key="`prd-${product.id}`"
    class="col"
  >
    <div class="card mb-4 rounded-3 shadow-sm">
      <div class="card-header py-3">
        <p class="my-0 fw-bolder">
          {{ product.name }}
        </p>
        <p>Category: {{ product.category.name }}</p>
      </div>
      <div class="card-body">
        <div v-html="shorterProductDescription" />
        <p>Price: {{ formattedPrice }}</p>
      </div>
      <div
        v-if="!product.is_active"
        class="card-footer"
      >
        <p class="text-muted mb-0">
          Product is not available anymore
        </p>
      </div>
      <div
        v-else
        class="card-footer"
      >
        <RouterLink
          :to="{name: 'product.display', params: {product: product.id}}"
          type="button"
          class="w-100 btn btn-lg btn-outline-success"
        >
          view product details
        </RouterLink>
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
    product: {
        type: Object,
        required: true
    }
})

const formattedPrice = computed(() => {
    return props.product.price + ' €';
});

const shorterProductDescription = computed(()=> {

    const allowedLength = 200;
    const short_desc = props.product.description_short;

    return short_desc.length > allowedLength ? short_desc.slice(0,allowedLength) + ' ...' : short_desc;
});
</script>
