<template>
    <header :class="show_visually_impaired ? 'show-visually-impaired' : ''">
        <base-visually-impaired />
        <div class="container">
            <div class="header-content">
                <ph-list size="2.5vw" class="header-icon" @click=""/>
                <nuxt-link to="/" class="home-link">
                    <img src="/assets/img/logo.svg" alt="" style="height: 5vw;">
                </nuxt-link>
                <ph-eye size="2.5vw" class="header-icon" @click="show_visually_impaired = !show_visually_impaired"/>
            </div>
        </div>
    </header>
</template>

<script setup>
import { 
    PhEye, 
    PhList  
} from "@phosphor-icons/vue";

const show_visually_impaired = ref(false);
</script>

<style>
header {
    margin-top: -90px;
    transition: 0.5s;
    position: fixed;
    width: 100%;
    backdrop-filter: blur(5px);
    background-color: rgba(255, 255, 255, 0.4);
    z-index: 100;
}

header.show-visually-impaired {
    margin-top: 0px;
}

header .container {
    display: flex;
    align-items: center;
    gap: 40px;
}

.header-content {
    padding: 10px 0;
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
}

a.home-link {
    color: var(--text);
    display: flex;
    align-items: center;
    gap: 16px;
}

.header-icon {
    cursor: pointer;
    color: var(--text);
    transition: 0.5s;
}

.header-icon:hover {
    color: var(--accent);
}
</style>