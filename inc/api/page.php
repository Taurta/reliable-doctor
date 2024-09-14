<?php
add_action( 'rest_api_init', function () {
    register_rest_route( 'methods', '/page', array(
        'methods' => 'GET',
        'callback' => 'getPage',
        'permission_callback' => '__return_true',
    ) );
} );

function getPage( WP_REST_Request $request ) {
    
    $query = $request->get_query_params();

    $page = get_page_by_path( $query['path'], 'OBJECT', ['page'] );

    if (!$page) {
        return new WP_Error( 'Invalid page', 'Страница не найдена', array( 'status' => 404 ) );
    }

    $data = get_fields($page->ID);
    
    $data['content'] = $page->post_content;
    $data['title'] = $page->post_title;
    
    // // Для страниц с постами
    // switch ($page->post_name) {
    //     case 'news':
    //         $data['news'] = getNews();
    //         break;
    //     case 'cases':
    //         $data['cases'] = getCases();
    //         break;
    // }

    return $data;
}

// function getCases() {
//     $args = [
//         'post_type' => 'cases',
//         'posts_per_page' => -1,
//         'numberposts' => -1,
//         'meta_key' => 'year',
//         'orderby' => ['meta_value_num' => 'DESC'],
//     ];
    
//     $query = new WP_Query($args);

//     $cases = [];
//     foreach ($query->posts as $post) {
//         $fields = get_fields($post);
//         $cases[] = [
//             'img' => $fields['background'],
//             'title' => $fields['title'],
//             'field' => $fields['field'],
//             'text' => $fields['desc'],
//             'link' => '/cases/' . $post->post_name,
//             'slide_name' => $post->post_title,
//             'position' => $fields['position'],
//         ];
//     }

//     return $cases;
// }

// function getNews() {
//     try {
//         $args = [
//             'post_type'      => 'news',
//             'numberposts'    => -1,
//             'posts_per_page' => -1,
//             'meta_key'       => 'date',
//             'orderby'        => 'meta_value',
//             'order'          => 'DESC'
//         ];

//         $query = new WP_Query($args);
//         $news = $query->posts;

//         if($news) {
//             foreach($news as $key=>$post) {
//                 $news[$key] = [
//                     'title' => $post->post_title,
//                     'desc' => $post->post_content,
//                     'date' => get_fields($post)['date'],
//                     'imgs' => get_fields($post)['imgs'],
//                 ];
//             }
//         }

//         return $news;
//     } catch(\Throwable $error) {
//         return $error;
//     }
// }