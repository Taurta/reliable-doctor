const BASE_API_PATH = 'https://your-startup.space';

export default defineNuxtRouteMiddleware(async (to, from) => {
    let path = to.path == '/' ? '/home' : to.path;

    if (path == '/404') {
        return;
    }

    try {
        if (path[path.length - 1] == '/') {
            path = path.slice(0, -1);
        }

        const { data: page } = useNuxtData('page' + path);

        if (page.value?.seo) {
            useSeoMeta({
                title:         page.value.seo?.title,
                ogTitle:       page.value.seo?.title,
                description:   page.value.seo?.description,
                ogDescription: page.value.seo?.description,
                ogImage:       page.value.seo?.img,
                twitterCard:   'summary_large_image',
            });

            return;
        }

        const path_array = path.split('/').filter((item) => (item != '' && item != undefined && item != 'undefined'));

        if (path_array.length == 1) {
            const { data, error } = await useFetch(BASE_API_PATH + '/v1/methods/page?path=' + path_array[0], { key: 'page' + path });

            if (error?.value?.statusCode == 404) {
                return navigateTo('/404');
            }
        } else {
            const { data, error } = await useFetch(BASE_API_PATH + '/v1/methods/' + path_array[0] + '?path=' + path_array[1], { key: 'page' + path });

            if (error?.value?.statusCode == 404) {
                return navigateTo('/404');
            }
        }

        useSeoMeta({
            title:         page.value.seo?.title,
            ogTitle:       page.value.seo?.title,
            description:   page.value.seo?.description,
            ogDescription: page.value.seo?.description,
            ogImage:       page.value.seo?.img,
            twitterCard:   'summary_large_image',
        });

    } catch (error) {
        console.log(error);
    }
})