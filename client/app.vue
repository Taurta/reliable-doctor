<template>
    <div class="app-wrapper" :class="[theme, size]">
        <BasePreloader/>
        <n-config-provider :theme-overrides="themeOverrides" :locale="ruRU"
            :date-locale="dateRuRU">
            <n-message-provider>
                <n-notification-provider placement="bottom-right">
                    <n-dialog-provider>
                        <base-scrollbar>
                            <NuxtLayout>
                                <NuxtPage />
                            </NuxtLayout>
                        </base-scrollbar>
                    </n-dialog-provider>
                </n-notification-provider>
            </n-message-provider>
        </n-config-provider>
    </div>
</template>

<script setup>
import {
    ruRU,
    dateRuRU,
    NConfigProvider,
    NMessageProvider,
    NNotificationProvider,
    NDialogProvider,
} from 'naive-ui'

const themeOverrides = {
    common: {
        primaryColor: '#0000ff',
        primaryColorHover: '#bec1eb',
        primaryColorPressed: '#bec1eb',
        primaryColorSuppl: '#0000ff',
    },
}

const theme = useCookie("theme");
const size  = useCookie("size");

const loading = useState('loading');
loading.value = true;

onMounted(() => {
    loading.value = false;
})
</script>

<style src="~/assets/css/roots.css" />
<style src="~/assets/css/base.css" />