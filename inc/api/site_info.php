<?php
add_action( 'rest_api_init', function () {
    register_rest_route( 'methods', '/site_info', array(
    'methods' => 'GET',
    'callback' => 'getSiteInfo',
    'permission_callback' => '__return_true'
    ) );
} );
function getSiteInfo( WP_REST_Request $request ) {
    //Собираем существующие меню с сайта
    $nav_menu_items = [
        'header' => wp_get_nav_menu_items('header'),
        'footer' => wp_get_nav_menu_items('footer'),
    ];
    $nav_menu_result = [];
    //берём url сайта
    $site_url = get_site_url();

    /** Функция формирует дерево из масства ключей и массива с массивами
    * @param array $array - Массив с значениями равными ключу во втором массиве
    * @param array $key_names - Массив с значениями равными массивам которые должны быть вложены в первый массив
    */
    function madeLinkTree($array, $key_arrays){
        $result = $array;
        foreach ($array as $key => $element) {
            if ($key_arrays[$element]){
                // echo $element."\n";
                $result[$key] = [
                    "$element" => madeLinkTree($key_arrays[$element], $key_arrays)
                ];
            }
        }
        return $result;
    }

    /** Функция выдает имена каждому элементу дерева по ключу
    * @param array $array - дерево с значениями равными ключу во втором массиве
    * @param array $key_names - Массив с значениями равными значениям ключей первого массива
    */
    function treeNames($array, $key_names){
        $result = [];
        foreach ($array as $key => $value) {
            if (is_array($value)){
                foreach ($value as $key => $value) {
                    $result[] = [
                        "label"=>$key_names[$key]["title"],
                        "link"=>$key_names[$key]["url"],
                        "children"=>treeNames($value, $key_names)
                    ];
                    break;//берём первый
                }
                continue;
            }
            $result[] = [
                "label"=>$key_names[$value]["title"],
                "link"=>$key_names[$value]["url"],
                "children"=>treeNames($value, $key_names)
            ];
        }
        return $result;
    }

    //? Главный цикл
    foreach ($nav_menu_items as $menu => $items) {
        foreach ($items as $item) {
            $links[$item->ID] = [
                "url"=>$item->url,
                "title"=>$item->title,
                "order"=>$item
            ];
            $nav_menu_result[$item->menu_item_parent][] = $item->ID;
        }

        try {
            $who = $nav_menu_result[0];
            $linkTree = madeLinkTree($who, $nav_menu_result);
            $namedLinks = treeNames($linkTree, $links);
        } catch (\Throwable $th) {
            echo $th;
            die;
        }
        
        return $namedLinks;
        $result[$menu] = $namedLinks;

    }
    

    $result = [
        "result"=>$result,
        "contacts" => get_field('contacts', 'options')
    ];

    return $result;
}

?>