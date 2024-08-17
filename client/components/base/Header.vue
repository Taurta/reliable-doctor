<template>
    <header :class="show_visually_impaired ? 'show-visually-impaired' : ''">
        <base-visually-impaired />
        <div class="header-content">
            <div class="container">
                HEADER
                <nuxt-link to="/">
                    <img src="/assets/img/logo.svg" alt="" style="height: 40px;">
                </nuxt-link>
                <ph-eye :size="24" style="cursor: pointer;" @click="show_visually_impaired = !show_visually_impaired"/>
            </div>
        </div>
    </header>
</template>

<script setup>
import { PhEye } from "@phosphor-icons/vue";

const show_visually_impaired = ref(false);
</script>

<style>
header {
    border-bottom: 1px solid gray;
    margin-top: -90px;
    transition: 0.5s;
}

header.show-visually-impaired {
    margin-top: 0px;
}

.header-content {
    padding: 20px 0;
}

header .container {
    display: flex;
    align-items: center;
    gap: 40px;
}
</style>