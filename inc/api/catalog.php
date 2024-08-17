<?php
add_action( 'rest_api_init', function () {
    register_rest_route( 'methods', '/catalog', array(
    'methods' => 'POST',
    'callback' => 'catalog',
    'permission_callback' => '__return_true'
    ) );
} );

function generate_filters(){

    //Генерирует список фильтров для вывода на фронте
    $filters = [];
    $taxonomies = get_taxonomies(['object_type' => ["page"]]); //меняем на тип поста нашего каталога
    $terms = [];
    foreach ($taxonomies as $tax_name) {
        $terms[$tax_name] = get_terms(['taxonomy'=>$tax_name]);
    }

    foreach ($terms as $name_category => $category) {
        $childrens = [];
        foreach ($category as $term) {
            $childrens[] = [
                "label"=>$term->name,
                "value"=>$term->slug,
            ];
        }
        
        $filters[] = [
            "name"=>$name_category,
            "label"=>get_taxonomy($name_category)->label,
            "children"=>$childrens
        ];
    }

    return $filters;
}

function catalog(WP_REST_Request $request){
    $params = $request->get_params();
    $post_type = "page";//меняем на наш тип поста
    //Пагинация
    $pagination = $params['pagination'] ?? [
        'page' => $params['pagination']['page'] ?? 1,
        'posts_per_page' => $params['pagination']['posts_per_page'] ?? 20,
    ];

    // Таксономии
    $tax_query = [];
    foreach ($params["filters"] as $tax => $terms) {
        $tax_query[] = [
            'taxonomy' => $tax,
            'field' => 'slug',
            'operator' => "in",
            'terms' => $terms
        ];
    }

    //Аргументы
    $args = [
        'post_type' => $post_type,
        'paged' => $pagination['page'],
        'posts_per_page' => $pagination['posts_per_page'],
    ];
    $args['tax_query'] = $tax_query;
    $query = new WP_Query( $args );
    $posts_array[] = $query->posts;

    //Получение полей
    $result_posts = [];
    foreach ($posts_array as $posts) {
        if (!empty($posts)) {
            foreach ($posts as $key=>$post) {
                $fields = get_fields($post);
                $result_posts[] =[
                    'id'    => $post->ID,
                    'title' => $post->post_title,
                    'slug' => $post->post_name,
                    'type'  => $post->post_type,
                    'fields' => $fields,
                ];
            }
        }
    }


    //Формирование результата
    $result = [
        "filters" => generate_filters(),
        "catalog" => $result_posts
    ];

    $result['pagination'] = [
        'count_pages' => ceil($query->found_posts /  $pagination['posts_per_page']),
        'count_items' => $query->found_posts,
        'count_on_page' => count($query->posts),
        'page' =>  $pagination['page'],
    ];

    return $result;
}

?>