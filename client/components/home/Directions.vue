<template>
    <section id="directions">
        <div class="container">
            <h2>
                Направления
            </h2>
            <div class="directions">
                <div v-for="direction, index in directions" class="directions-card" :key="index">
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
const directions = [
    {
        title: 'Кардиология',
        text: 'Диагностика и лечение заболеваний сердечно-сосудистой системы, включая аритмии, гипертонию, ишемическую болезнь сердца и сердечную недостаточность.',
    },
    {
        title: 'Терапевтия',
        text: 'Комплексный подход к лечению различных заболеваний внутренних органов, включающий профилактику, диагностику и разработку индивидуальных планов лечения.',
    },
    {
        title: 'Неврология',
        text: 'Оказание помощи при заболеваниях нервной системы, таких как инсульт, эпилепсия, мигрень и рассеянный склероз.',
    },
    {
        title: 'Капельницы',
        text: 'Введение лекарственных препаратов и витаминов внутривенно для поддержания и улучшения общего состояния организма.',
    },
    {
        title: 'Анализы',
        text: 'Проведение лабораторных исследований крови, мочи и других биоматериалов для точной диагностики и контроля эффективности лечения.',
    },
    {
        title: 'Инъекции',
        text: 'Выполнение внутримышечных и подкожных инъекций для быстрого введения лекарственных препаратов.',
    },{
        title: 'Постановка и уход за катетерами',
        text: 'Профессиональная установка и последующий уход за катетерами для обеспечения надёжного доступа к венам или мочевому пузырю.',
    },
    {
        title: 'Уход за тяжелобольными',
        text: 'Комплексный уход за пациентами с тяжёлыми заболеваниями, включая контроль состояния, введение лекарств и поддержка жизненно важных функций.',
    }
]
</script>

<style>
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
    padding: 20px;
    border: 1px solid var(--light-accent);
    border-radius: 8px;
    transition: 0.5s;
}

.directions-card:hover {
    border: 1px solid var(--accent);
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