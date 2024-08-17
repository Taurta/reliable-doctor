<template>
	<div class="visually-impaired">
		<div class="visually-impaired-group size">
			<div class="visually-impaired-label">Размер шрифта:</div>
			<div class="visually-impaired-size-group">
				<div class="visually-impaired-size" :class="is_active_size == 'low_size' ? 'active' : ''"
					@click="switchParams('size', 'low_size')">
					А
				</div>
				<div class="visually-impaired-size" :class="is_active_size == 'medium_size' ? 'active' : ''"
					@click="switchParams('size', 'medium_size')">
					А
				</div>
				<div class="visually-impaired-size" :class="is_active_size == 'large_size' ? 'active' : ''"
					@click="switchParams('size', 'large_size')">
					А
				</div>
			</div>
		</div>
		<div class="visually-impaired-group color">
			<div class="visually-impaired-label">Цвет сайта:</div>
			<div class="visually-impaired-color-group">
				<div class="visually-impaired-color" :class="is_active_theme == 'monochrome' ? 'active' : ''"
					@click="switchParams('theme', 'monochrome')">
					А
				</div>
				<div class="visually-impaired-color" :class="is_active_theme == 'dark' ? 'active' : ''"
					@click="switchParams('theme', 'dark')">
					А
				</div>
				<div class="visually-impaired-color" :class="is_active_theme == 'blue' ? 'active' : ''"
					@click="switchParams('theme', 'blue')">
					А
				</div>
			</div>
		</div>
		<div class="visually-impaired-group visually-impaired-img">
			<div class="visually-impaired-label">Изображения</div>
			<n-switch v-model:value="is_active_image" @update:value="switchParams('image', is_active_image)" />
		</div>
		<div class="visually-impaired-group">
			<n-button type="error" @click="reset">
				Сбросить настройки
			</n-button>
		</div>
	</div>
</template>

<script setup>
import { NSwitch, NButton } from "naive-ui";

const theme = useCookie("theme");
const size  = useCookie("size");
const image = useCookie("image");

const is_active_theme = ref(null);
is_active_theme.value = theme.value;

const is_active_size = ref(null);
is_active_size.value = size.value;

const is_active_image = ref(true);
is_active_image.value = image.value;

function switchParams(param, variant) {
	switch (param) {
		case 'theme':
			theme.value = variant;
			is_active_theme.value = variant;
			break;

		case 'size':
			size.value = variant;
			is_active_size.value = variant;
			break;

		case 'image':
			image.value = variant;
			is_active_image.value = variant;
			break;
	}
}

function reset() {
	theme.value           = '';
	is_active_theme.value = '';
	size.value            = '';
	is_active_size.value  = '';
	image.value           = true;
	is_active_image.value = true;
}
</script>

<style>
.visually-impaired {
	background-color: #ededed;
	color: #2e2e2e;
	padding: 20px;
	display: flex;
	align-items: center;
	justify-content: center;
	column-gap: 40px;
}

.visually-impaired-group {
	display: flex;
	align-items: center;
	column-gap: 20px;
}

.visually-impaired-label {
	font-size: 16px;
	font-weight: 600;
	line-height: 24px;
	letter-spacing: 0.045em;
	text-align: left;
}

.visually-impaired-size-group,
.visually-impaired-color-group {
	column-gap: 9px;
	display: flex;
	align-items: center;
	height: 50px;
}

.visually-impaired-size,
.visually-impaired-color {
	width: 33px;
	height: 34px;
	border-radius: 5px;
	color: #2e2e2e;
	font-size: 18px;
	font-weight: 700;
	line-height: 24px;
	letter-spacing: 0.045em;
	background-color: #fff;
	display: flex;
	align-items: center;
	justify-content: center;
	cursor: pointer;
	position: relative;
	transition: .5s;
}

.visually-impaired-size::after,
.visually-impaired-color::after {
	content: "";
	transition: 0.5s;
	position: absolute;
	top: calc(100% + 4px);
	width: 0;
	height: 3px;
	background-color: #2e2e2e;
	border-radius: 5px;
}

.visually-impaired-size.active::after,
.visually-impaired-color.active::after  {
	width: 100%;
}

.visually-impaired-color {
	width: 37px;
	height: 42px;
	font-size: 24px;
}

.visually-impaired-size:nth-of-type(2) {
	width: 37px;
	height: 42px;
	font-size: 24px;
}

.visually-impaired-size:nth-of-type(3) {
	width: 43px;
	height: 50px;
	font-size: 32px;
}

.visually-impaired-color:nth-of-type(2) {
	background-color: #2e2e2e;
	color: #fff;
}

.visually-impaired-color:nth-of-type(3) {
	background-color: #a0c6ff;
	color: #205593;
}

.visually-impaired-img {
	height: 50px;
	opacity: 1;
}

.visually-impaired-img.active {
	opacity: 0;
}

@media screen and (max-width: 1200px) {
	.visually-impaired {
		justify-content: space-between;
	}

	.visually-impaired-group.size {
		display: none;
	}

	.visually-impaired-group {
		align-items: center;
		justify-content: center;
		gap: 10px;
	}

	.visually-impaired-group.color {
		flex-direction: column;
		align-items: flex-start;
	}

	.visually-impaired-label {
		font-size: 12px;
		line-height: 16px;
		letter-spacing: 0.045em;
	}

	.visually-impaired-size,
	.visually-impaired-color {
		width: 30px;
		height: 30px;
		border-radius: 5px;
		font-size: 14px;
	}

	.visually-impaired-size:nth-of-type(2) {
		width: 30px;
		height: 30px;
		font-size: 14px;
	}

	.visually-impaired-size:nth-of-type(3) {
		width: 30px;
		height: 30px;
		font-size: 14px;
	}

	.visually-impaired-size-group,
	.visually-impaired-color-group {
		height: 30px;
	}
}
</style>