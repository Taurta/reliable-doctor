<template>
    <n-scrollbar class="app-scrollbar" ref="scrollbar_ref" @scroll="scroll">
            <slot />
    </n-scrollbar>
</template>

<script setup>
import { NScrollbar } from 'naive-ui';

const scrollbar_ref = ref(null);
const scrollbar = useState('scrollbar');
const scrollY   = useState('scrollY');

onMounted(() => {
    scrollbar.value = scrollbar_ref.value;
})

function scroll(e) {
    scrollY.value = e.target.scrollTop;
}
</script>

<style>
.app-scrollbar {
    max-height: 100vh;
    scroll-behavior: smooth;
}
</style>