<?php

/**
 * Function for `save_post` action-hook.
 * 
 * @param int     $post_id Post ID.
 * @param WP_Post $post    Post object.
 * @param bool    $update  Whether this is an existing post being updated.
 *
 * @return void
 */

function translit($value)
{
    $converter = array(
        'а' => 'a',    'б' => 'b',    'в' => 'v',    'г' => 'g',    'д' => 'd',
        'е' => 'e',    'ё' => 'e',    'ж' => 'zh',   'з' => 'z',    'и' => 'i',
        'й' => 'y',    'к' => 'k',    'л' => 'l',    'м' => 'm',    'н' => 'n',
        'о' => 'o',    'п' => 'p',    'р' => 'r',    'с' => 's',    'т' => 't',
        'у' => 'u',    'ф' => 'f',    'х' => 'h',    'ц' => 'c',    'ч' => 'ch',
        'ш' => 'sh',   'щ' => 'sch',  'ь' => '',     'ы' => 'y',    'ъ' => '',
        'э' => 'e',    'ю' => 'yu',   'я' => 'ya',
        
        'А' => 'A',    'Б' => 'B',    'В' => 'V',    'Г' => 'G',    'Д' => 'D',
        'Е' => 'E',    'Ё' => 'E',    'Ж' => 'Zh',   'З' => 'Z',    'И' => 'I',
        'Й' => 'Y',    'К' => 'K',    'Л' => 'L',    'М' => 'M',    'Н' => 'N',
        'О' => 'O',    'П' => 'P',    'Р' => 'R',    'С' => 'S',    'Т' => 'T',
        'У' => 'U',    'Ф' => 'F',    'Х' => 'H',    'Ц' => 'C',    'Ч' => 'Ch',
        'Ш' => 'Sh',   'Щ' => 'Sch',  'Ь' => '',     'Ы' => 'Y',    'Ъ' => '',
        'Э' => 'E',    'Ю' => 'Yu',   'Я' => 'Ya',
    );
    
    $value = strtr($value, $converter);
    return $value;
}

add_action( 'save_post', 'update_link_on_save', 10, 3);
//Транслит ссылки при обновлении поста
function update_link_on_save( $post_id, $post, $update ){
    try{
	// Определяет является ли указанная запись (пост) ревизией (редакцией записи).
    $types = ["instructor","service","publication","page"];
    if (!in_array($post->post_type,$types)) return;
    // return;
	if ( ! wp_is_post_revision( $post_id ) ) {
		// Предотвращаем бесконечное зацикливание
		remove_action( 'save_post', 'update_link_on_save' );
		// обновляем slug

        $slug = (translit(urldecode($post->post_name)));
		wp_update_post( array(
			'ID' => $post_id,
			'post_name' => $slug 
		));
		// возвращаем хук
		add_action( 'save_post', 'update_link_on_save' );
	}

    }catch(Throwable $e){
        echo 'Возникла ошибка в update_link_on_save <br>';
        echo $e . '<br>';
        // echo '<a href="' . 'https://slavyanskie-dveri.ru/wp-admin/post.php?post=' . $post_id . '&action=edit' . '">Вернуться к редактированию</a>';
    }
}