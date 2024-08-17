<template>
    <div :class="'preloader ' + (loading? 'active' : '')">
        <slot>
            <div class="lds-ring">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </slot>
    </div>
</template>
<script setup>

const nuxtApp = useNuxtApp();
const loading = ref(true);

nuxtApp.hook("page:loading:start", () => {
    loading.value = true;
});

nuxtApp.hook("page:loading:end", () => {
    setTimeout(() => {
        loading.value = false;
    }, 400)
});
</script>

<style>
.preloader {
    background-color: #FFF;
    display: flex;
    align-items: center;
    justify-content: center;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 10000;
    pointer-events: none;
    opacity: 0;
    transition: 0.4s;
}

.preloader.active {
    pointer-events: all;
    opacity: 1;
    transition: 0s;
}

.lds-ring {
    display: inline-block;
    position: relative;
    width: 80px;
    height: 80px;
}

.lds-ring div {
    box-sizing: border-box;
    display: block;
    position: absolute;
    width: 64px;
    height: 64px;
    margin: 8px;
    border: 8px solid #3D44F1;
    border-radius: 50%;
    animation: lds-ring 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
    border-color: #3D44F1 transparent transparent transparent;
}

.lds-ring div:nth-child(1) {
    animation-delay: -0.45s;
}

.lds-ring div:nth-child(2) {
    animation-delay: -0.3s;
}

.lds-ring div:nth-child(3) {
    animation-delay: -0.15s;
}

@keyframes lds-ring {
    0% {
        transform: rotate(0deg);
    }

    100% {
        transform: rotate(360deg);
    }
}
</style>