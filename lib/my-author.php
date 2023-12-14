<?php 
if($newArr['param'] == "add_author") {
    $wpdb->insert('wp_my_authors', array(
        'name' => $newArr['name'],
        'fb_link' => $newArr['fb_link'],
        'about' => $newArr['about'],
    ));
    echo json_encode(array("status" => 1, "message" => 'Author created successfully!'));
    wp_die();
} 