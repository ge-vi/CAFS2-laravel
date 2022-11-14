<script setup>
const props = defineProps({
    title: {
        type: String,
        default: '*.vue'
    }
});
</script>

<template>
  <p class="text-center">
    <code>{{ props.title }}</code>
  </p>
</template>
