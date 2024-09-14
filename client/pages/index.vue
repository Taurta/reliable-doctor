<template>
    <home-main :data="page?.main" />
    <home-directions :data="page?.directions" />
    <home-stages :data="page?.stages" />
    <home-about :data="page?.about" />
</template>

<script setup>
const { data: page } = useNuxtData('page/home');
</script>