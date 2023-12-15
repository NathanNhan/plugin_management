<?php 

if($newArr['param'] == "add_course") {
     
        $wpdb->insert('wp_my_enroll', array(
            'student_id' => $newArr['studentid'],
            'book_id' => $newArr['bookid'],
        ));
        echo json_encode(array("status" => 1, "message" => 'User created successfully!'));
        wp_die();

    

}