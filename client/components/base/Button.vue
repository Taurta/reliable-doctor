<template>
    <nuxt-link v-if="href" class="button">

    </nuxt-link>
    <button v-else class="button" :class="type">
        <slot />
    </button>
</template>

<script setup>
const props = defineProps({
    href: {
        type: String,
        default: '',
    },
    type: {
        type: String,
        default: '',
    }
})
</script>

<style>
.button {
    font-size: var(--text_size);
    line-height: var(--text_size_lh);
    cursor: pointer;
    border-radius: calc(var(--text_size_lh) * 2);
    border: none;
    box-shadow: none;
    color: var(--bg);
    padding: calc(var(--text_size_lh) / 2) var(--text_size_lh);
    background-color: var(--light-accent);
    transition: 0.5s;
}

.button:hover {
    background-color: var(--accent);
    box-shadow: 0 0 10px var(--accent);
}

.button.second {
    color: var(--light-accent);
    background-color: var(--bg);
    border: 1px solid var(--light-accent);
}

.button.second:hover {
    color: var(--bg);
    background-color: var(--accent);
    border: 1px solid var(--accent);
    box-shadow: 0 0 10px var(--accent);
}
</style>