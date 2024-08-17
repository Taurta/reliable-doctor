<?php
add_action( 'rest_api_init', function () {
    register_rest_route( 'methods', '/page/(?P<id>.+\S)', array(
        'methods' => 'GET',
        'callback' => 'getPage',
        'permission_callback' => '__return_true',
    ) );
} );

function getPage( WP_REST_Request $request ) {
    
    $slug = $request->get_param('id');

    $page = get_page_by_path( $slug );

    if (!$page || $page->post_status == "draft") {
        return new WP_Error( 'Invalid page', 'Страница не найдена', array( 'status' => 404 ) );
    }
    $result = [
        'title' => $page->post_title,
        'content' => $page->post_content,
        'data' => get_fields($page->ID)
    ];
    
    return $result;
}

//? Страничка политики сайта?
add_action( 'rest_api_init', function () {
    register_rest_route( 'methods', '/policy/(?P<id>.+\S)', array(
        'methods' => 'GET',
        'callback' => 'getPP',
        'permission_callback' => '__return_true',
    ) );
} );

function getPP( WP_REST_Request $request ) {
    
    $id = $request->get_param('id');

    $page = get_page_by_path($id, OBJECT, 'policy');

    if (!$page) {
        return new WP_Error( 'Invalid page', 'Страница не найдена', array( 'status' => 404 ) );
    }

    $result = [
        'title' => $page->post_title,
        'content' => $page->post_content,
    ];
    
    return $result;
}