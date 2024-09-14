<template>
    <section id="directions" v-if="data?.length > 0">
        <div class="container">
            <h2>
                Направления
            </h2>
            <div class="directions">
                <div v-for="direction, index in data" class="directions-card" :class="(selected >= 0 && selected != index) ? 'blur' : ''" :key="index" ref="directions" @mouseenter="selected=index" @mouseleave="selected=-1">
                    <div class="directions-card-info">
                        <h3>
                            {{ direction.title }}
                        </h3>
                        <div class="direction-text" v-html="direction.text"></div>
                    </div>
                    <base-button type="second">
                        Запишитесь на прием
                    </base-button>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
const props = defineProps({
    data: {
        type: Array,
        default: () => []
    }
});

const directions = ref([]);
const selected = ref(-1);
</script>

<style>
#directions {
    padding-top: 0;
}

.directions {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 40px;
}

.directions-card {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    min-height: 300px;
    padding: 40px;
    border: 1px solid var(--text);
    border-radius: 45px;
    transition: 0.5s;
    box-shadow: 6px 6px 0px 0px var(--text);
}

.directions-card.blur {
    opacity: 0.4;
    filter: grayscale(1);
}

.directions-card:hover {
    color: var(--bg);
    background-color: var(--text);
    box-shadow: 6px 6px 0px 0px var(--accent);
}

.directions-card:hover button {
    background-color: var(--text);
}

.directions-card h3 {
    margin: 0 0 20px;
}

.direction-text {
    margin-bottom: 20px;
    font-size: var(--text_size);
    line-height: var(--text_size_lh);
}

.direction-text * {
    font-size: var(--text_size);
    line-height: var(--text_size_lh);
}

.directions-card button {
    width: max-content;
}

@media screen and (max-width: 1610px) {
    .directions {
        grid-template-columns: repeat(3, 1fr);
    }
}
</style>