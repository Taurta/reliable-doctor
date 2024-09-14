<template>
    <section id="stages" v-if="data?.length > 0">
        <div class="container">
            <h2>
                Как вызвать врача на дом?
            </h2>
            <div class="stages">
                <div v-for="stage, index in data" class="stage" :class="stage?.right ? 'right' : ''" :key="index">
                    <h3>
                        {{ stage.title }}
                    </h3>
                    <div class="stage-text" v-html="stage.text"></div>
                    <div class="stage-number">{{ numberFomat(index + 1) }}</div>
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
})
</script>

<style>
.stages {
    padding: 0 10%;
}

.stage {
    width: calc(50% + calc(var(--h1_lh) * 1.5));
    padding-right: calc(var(--h1_lh) * 3);
    margin: 100px 0;
    position: relative;
    text-align: right;
}

.stage.right {
    padding-right: 0;
    padding-left: calc(var(--h1_lh) * 3);
    margin-left: auto;
    text-align: left;
}

.stage h3 {
    margin: 0 0 20px;
}

.stage-text {
    font-size: var(--text_size);
    line-height: var(--text_size_lh);
}

.stage-text a {
    white-space: nowrap;
}

.stage-number {
    position: absolute;
    color: var(--accent);
    font-size: calc(var(--h1) * 2);
    line-height: calc(var(--h1) * 2);
    font-weight: 900;
    opacity: 0.1;
    top: 50%;
    right: 0;
    transform: translateY(-50%);
    width: calc(var(--h1_lh) * 3);
    text-align: center;
    transition: 0.5s;
}

.stage.right .stage-number {
    right:  auto;
    left: 0;
}

.stage:hover .stage-number{
    opacity: 1; 
}
</style>