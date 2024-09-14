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
    border-radius: calc(var(--text_size_lh) * 0.5);
    border: none;
    box-shadow: none;
    color: var(--bg);
    padding: calc(var(--text_size_lh) / 2) var(--text_size_lh);
    background-color: var(--text);
    transition: 0.5s;
    box-shadow: 3px 3px 0 0px var(--accent);
}

.button:hover {
    background-color: var(--accent);
    box-shadow: 3px 3px 0 0px var(--text);
}

.button:active {
    background-color: var(--light-accent);
    box-shadow: 0 0 0 0px var(--text);
    transition: 0.2s;
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
    box-shadow: 3px 3px 0 0px var(--bg);
}

.button.second:active {
    background-color: var(--light-accent);
    box-shadow: 0 0 0 0px var(--text);
}
</style>