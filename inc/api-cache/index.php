<?php
add_filter( 'rest_pre_dispatch', 'getCache', 10, 3 );

function getCache($result, $server, $request) {

    // Проверка наличия папки
    $path_to_cache  = get_template_directory() . '/inc/api-cache/temp';

    if (!file_exists($path_to_cache)) {
        mkdir($path_to_cache);
        return false;
    }

    // Формирование имени файла
    $params = $request->get_params();
    $query  = $request->get_query_params();
    $route  = $request->get_route();

    $api_full_path = $route . json_encode($query) . json_encode($params);
    $hash = hash('sha256', $api_full_path);

    // Проверка наличия файла с кешем
    $path_to_file = $path_to_cache . '/' . $hash . '.json';

    if (!file_exists($path_to_file)) {
        return false;
    }

    $file = json_decode(file_get_contents($path_to_file));
    $now  = new DateTimeImmutable();

    // Если дата не указана или истекла удаляем кеш
    if (empty($file->end_date) || $now->getTimestamp() > $file->end_date) {
        unlink($path_to_file);
        return false;
    }

    return $file->content;
}

// Добавляет ссылку в админ бар
add_action( 'admin_bar_menu', 'my_admin_bar_menu', 70 );
function my_admin_bar_menu( $wp_admin_bar ) {
	$wp_admin_bar->add_menu( array(
		'id'    => 'menu_id',
		'title' => '<span class="ab-icon dashicons-image-rotate" style="top:2px">
        </span><span class="ab-label">Сброс кэша</span>',
		'href'  => "?reset_cache=y",
	) );
}
if ($_GET["reset_cache"]){
    //Удаление кэша
    $files = glob('../wp-content/themes/doors/inc/api-cache/temp/*'); // get all file names
    foreach($files as $file){ // iterate files
        if(is_file($file)) {
            $log = json_encode($file);
            unlink($file); // delete file
        }
    }
}

add_filter( 'rest_post_dispatch', 'setCache', 10, 3 );

function setCache( $result, $server, $request ) {
    // Список кешируемых запросов
    $requests_array = [
        '/doors',
        '/filters',
        '/product/',
        '/fortune',
        '/company',
        '/home',
        '/page/',
        '/site_info',
    ];

    $route = $request->get_route();
    $is_enable = false;

    foreach ( $requests_array as $item) {
        if (strpos($route, $item) !== false) {
            $is_enable = true;
            break;
        }
    }

    if (!$is_enable) {
        return $result;
    }

    // Формирование имени файла
    $params = $request->get_params();
    $query  = $request->get_query_params();

    $api_full_path = $route . json_encode($query) . json_encode($params);
    $hash = hash('sha256', $api_full_path);

    // Проверка наличия файла с кешем
    $path_to_file = get_template_directory() . '/inc/api-cache/temp/' . $hash . '.json';

    if (file_exists($path_to_file)) {
        return $result;
    } 

    // Создаем кеш
    $time_to_die = 1000 * 60 * 60; // 1 min
    $now         = new DateTimeImmutable();
    $data        = $result->get_data();

    $cache = [
        'end_date' => $now->getTimestamp() + $time_to_die,
        'content'  => $data,
    ];

    file_put_contents($path_to_file, json_encode($cache));
    
	return $result;
}