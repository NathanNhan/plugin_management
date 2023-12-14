<?php 

if($newArr['param'] == "add_student") {
     
        $student_id = wp_create_user( $newArr['username'], $newArr['password'], $newArr['email'] );
        //assign new user to role = my book user 
        if(username_exists($newArr['username']) || email_exists( $newArr['email'] )) {
            echo json_encode(array("status" => 2, "message" => 'Username or email must be unique!!!'));
            wp_die();
        } 
        $user = new WP_User($student_id);
        $user->set_role('wp_my_book_user');
        $wpdb->insert('wp_my_students', array(
            'name' => $newArr['name'],
            'email' => $newArr['email'],
            'user_login_id' => $student_id,
        ));
        echo json_encode(array("status" => 1, "message" => 'User created successfully!'));
        wp_die();

    

}