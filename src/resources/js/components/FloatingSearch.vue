<template>
  <div class="form-floating mb-3">
    <input
      id="searchInput"
      class="form-control"
      placeholder="search"
      :value="modelValue"
      @input="$emit('update:modelValue', $event.target.value)"
    >
    <label for="searchInput">{{ searchLabel }}</label>
  </div>
</template>

<script setup>

defineProps({
    searchLabel: {
        type: String,
        default: 'Search'
    },
    modelValue: {
        type: String,
        default: null
    }
})

defineEmits(['update:modelValue']);

</script>
