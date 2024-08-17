<template>
    <base-error-page :error="error"/>
</template>

<script setup>
const props = defineProps({
  error: Object,
})
</script>