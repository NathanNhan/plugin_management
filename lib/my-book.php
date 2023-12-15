<?php 
    if($newArr['param'] == "save_book") {
        $wpdb->insert('wp_my_books', array(
            'name' => $newArr['name'],
            'author' => $newArr['author'],
            'about' => $newArr['about'],
            'image' => $newArr['image_value'],
        ));
        echo json_encode(array("status" => 1, "message" => 'Book created successfully!'));
        wp_die();

    } else if ($newArr['param'] == "update_book") {
        $wpdb->update('wp_my_books', array(
            'name' => $newArr['name'],
            'author' => $newArr['author'],
            'about' => $newArr['about'],
            'image' => $newArr['image_value'],
        ), array(
            'id' => $newArr['book_id']
        ));
        echo json_encode(array("status" => 1, "message" => 'Book created successfully!'));
        wp_die();
    } else if($newArr['param'] == 'delete_book') {
        print_r($newArr['id']);
        $wpdb->delete('wp_my_books', array( 'id' => $newArr['id']));
        echo json_encode(array("status" => 1, "message" => 'Book created successfully!'));
        wp_die();
    }