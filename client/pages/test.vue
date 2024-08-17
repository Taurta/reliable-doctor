<template>
    <section id="test" style="min-height: 100vh;">
        <div class="container">
            <n-h2>Скролл</n-h2>
            <n-h3>Текущая прокрутка {{ scrollY }}</n-h3>
            <n-button @click="scrollBy(50)">
                Скролл на 50px
            </n-button>
        </div>
    </section>
</template>

<script setup>
import {
    NH2,
    NH3,
    NButton,
} from 'naive-ui';

// Работа со скролом -----------------------------------------------
const scrollbar = useState('scrollbar');
const scrollY   = useState('scrollY');

function scrollBy(top) {
    // https://www.naiveui.com/en-US/dark/components/scrollbar
    scrollbar.value.scrollBy({
        top,
        behavior: 'smooth',
    })
}
// -------------------------------------------------------------------
</script>