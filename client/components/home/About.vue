<template>
    <section id="about" v-if="data">
        <div class="container">
            <h2>
                О нас
            </h2>
            <div class="about-content">
                <div class="about-text" v-html="data?.text"></div>
                <div class="about-img">
                    <img :src="data?.img" alt="">
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
const props = defineProps({
    data: {
        type: Object,
        default: () => {},
    }
});
</script>

<style>
.about-content {
    display: flex;
    gap: 40px;
    align-items: center;
}

.about-img,
.about-text {
    width: 100%;
}

.about-img img {
    width: auto;
    height: 500px;
    margin: 0 auto;
    display: block;
    border-radius: 45px;
    box-shadow: 6px 6px 0px 0px var(--text);
    transition: 0.5s;
}

.about-img img:hover {
    box-shadow: 6px 6px 0px 0px var(--accent);
}
</style>