<template>
    <section id="error">
        <div class="container">
            <h1>{{ error.statusCode }}</h1>
            <NuxtLink to="/">На главную</NuxtLink>
        </div>
    </section>
</template>

<script setup>
const props = defineProps({
    error: {
        type: Object,
        default: {
            statusCode: 404,
        }  
    }
})
</script>