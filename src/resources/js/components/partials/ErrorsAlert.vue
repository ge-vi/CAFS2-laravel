<script setup>
import TemplateTitle from './TemplateTitle.vue'

const props = defineProps({
    errors: {
        type: Array,
        required: true
    }
});
</script>

<template>
  <div class="row">
    <template-title title="ErrorsAlert.vue" />

    <div class="alert alert-danger">
      <ul class="m-0">
        <li
          v-for="error in props.errors"
          :key="`err-${error.message}`"
          class="list-unstyled"
        >
          {{ error }}
        </li>
      </ul>
    </div>
  </div>
</template>
