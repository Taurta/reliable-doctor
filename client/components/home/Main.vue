<template>
    <section id="main">
        <div class="container">
            <div class="main-info">
                <div class="main-info-sub-title">
                    Клиника
                </div>
                <h1 class="main-info-title">
                    НАДЕЖНЫЙ ДОКТОР
                </h1>
                <div class="main-info-text">
                    ЭТО <span>ПОДДЕРЖКА</span> И <span>ЗАБОТА</span>
                </div>
                <div class="main-heart">
                    <ph-hand-heart weight="thin"/>
                    <ph-heart class="heart" weight="fill"/>
                </div>
            </div>
            <div class="main-btns">
                <base-button>
                    Запишитесь на прием
                </base-button>
                <span>
                    или
                </span>
                <base-button>
                    Вызовите врача на дом
                </base-button>
            </div>
           
            <!-- <div class="main-bg"></div> -->
        </div>
    </section>
</template>

<script setup>
import {
    PhHandHeart,
    PhHeart
} from '@phosphor-icons/vue'
</script>

<style>
#main {
    padding-top: 0;
}

#main .container {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-wrap: wrap;
    padding: calc(5vw + 20px) 20px;
    position: relative;
}

.main-info {
    position: relative;
    width: 100%;
}

.main-info-sub-title {
    font-size: 2.35vw;
    margin-bottom: 1vw;
    line-height: 1;
    color: var(--accent);
}

h1.main-info-title {
    margin: 0;
    font-size: 4.8vw;
    line-height: 1;
    margin-bottom: 1vw;
    font-weight: 800;
}

.main-info-title::after {
    content: '—';
}

.main-info-text {
    font-size: 4.1vw;
    line-height: 1;
    font-weight: 400;
}

.main-info-text span {
    color: var(--accent);
}

.main-btns {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: var(--h4_lh);
}

.main-btns span,
.main-btns .button {
    font-size: var(--h4);
    line-height: var(--h4_lh);
}

.main-heart {
    position: absolute;
    transform: rotateY(180deg);
    width: 30vw;
    height: 18vw;
    right: 0;
    bottom: -3vw;
    display: flex;
    align-items: center;
    justify-content: center;
}

.main-heart svg {
    width: 30vw;
    height: 18vw;
    color: var(--text);
}

.main-heart .heart {
    position: absolute;
    width: 12vw;
    height: 12vw;
    opacity: 0.7;
    animation: heartBeat 1.2s ease infinite 0s;
    left: 10.9vw;
    top: 1vw;
    z-index: -1;
    color: var(--accent);
    filter: blur(10px);
}

@keyframes heartBeat { 
    0%   { transform:scale(1);   }
    15%  { transform:scale(1.2); }
    25%  { transform:scale(1.1); }
    35%  { transform:scale(1.2); }
    100% { transform:scale(1);   }
}
</style>