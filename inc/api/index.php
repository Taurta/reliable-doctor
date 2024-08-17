<?php
add_filter( 'rest_url_prefix', function() {
    return 'v1';
} );

//? wp-admin helper
require_once get_template_directory() . '/inc/api/wp-admin_helper.php'; 
//? Заявки
require_once get_template_directory() . '/inc/api/request.php'; 
//? Каталог
require_once get_template_directory() . '/inc/api/catalog.php'; 
//? Отображение страниц
require_once get_template_directory() . '/inc/api/page.php'; 
//? общее для всех страниц
require_once get_template_directory() . '/inc/api/site_info.php'; 