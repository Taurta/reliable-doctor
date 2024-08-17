<?php

add_action( 'rest_api_init', function () {
    register_rest_route( 'methods', '/createRequest', array(
        'methods' => 'POST',
        'callback' => 'createRequest',
        'permission_callback' => '__return_true'
    ) );
} );

function createRequest( WP_REST_Request $request ) {

    include_once ABSPATH . 'wp-admin/includes/media.php';
    include_once ABSPATH . 'wp-admin/includes/file.php';
    include_once ABSPATH . 'wp-admin/includes/image.php';

    try {
       
        $params = $request->get_params();
        
        if (!$params['name'] || !$params['phone']) {
            return [
                'success' => false,
                'message' => 'Не заполнены обязательные данные.'
            ];
        }

        $fields = [];

        foreach ($params as $key => $item) {
            $fields[$key] = $item;
        }
        
        $title = 'Запрос на обратную связь от ' . wp_date('d.m.Y H:i:s');

        $request_data = array(
            'post_title'    => sanitize_text_field($title),
            'post_type'     => 'request',
            'post_status'   => 'pending',
        );
        
        $request_id = wp_insert_post( $request_data );
    
        if ( is_wp_error($request_id) ){
            return [
                'success' => false,
            ];
        }

        foreach ($fields as $key => $field) 
        {
            update_field($key, $field, $request_id);
        }
                
        $frame_fields = get_field_objects($request_id);

        $labels = [];

        foreach ($frame_fields as $field) {
            $labels[$field['name']] = $field['label'];
        }
        
        $txt = '<b>' . $title . '</b>' . "\n";
        foreach ($fields as $key => $field) {
            $name = '';
            foreach ($labels as $label_name => $label) {
                if ($key == $label_name) {
                    $name = $label;
                    $txt .= '<b>' . $name . ': </b>' . $field . "\n";
                }
            }
        }

        $botToken = get_field('tg_bot_token', 'options');
        $idGroup = get_field('tg_group_id', 'options');
    
        $url = "https://api.telegram.org/bot" . $botToken . "/sendMessage?chat_id=" . $idGroup . "&parse_mode=HTML";
        $url = $url . "&text=" . urlencode($txt);
        $ch = curl_init();
        $optArray = array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true
        );
        curl_setopt_array($ch, $optArray);
        $messageResult = curl_exec($ch);
        curl_close($ch);
      
        if (is_uploaded_file($_FILES['file']['tmp_name'])) {
            $attachment_id = media_handle_upload('file', $request_id); 
            if ( is_wp_error( $attachment_id ) ) {
                return [
                    'success'  => false,
                    'message' => $attachment_id->get_error_message(),
                ];
            } 

            update_field('file', $attachment_id, $request_id);
    
            $arrayQuery = array(
                'chat_id' => $idGroup,
                'caption' => 'Приложение',
                'document' => curl_file_create(wp_get_attachment_url($attachment_id))
            );	
            $ch = curl_init('https://api.telegram.org/bot'. $botToken .'/sendDocument');
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $arrayQuery);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, false);
            $res = curl_exec($ch);
            curl_close($ch);
        } 

        return [
            'success' => ourEmail($txt, $title)
        ];
    } 

    catch (Exception $e) {
        return [
            'success'  => false,
            'message' => $e->getMessage(),
        ];
    }
}
