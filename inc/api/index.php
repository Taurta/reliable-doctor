<?php
add_filter( 'rest_url_prefix', function() {
    return 'v1';
} );

//? Заявки
require_once get_template_directory() . '/inc/api/request.php';  
//? Отображение страниц
require_once get_template_directory() . '/inc/api/page.php'; 
//? общее для всех страниц
require_once get_template_directory() . '/inc/api/site_info.php'; 