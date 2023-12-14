<?php 

class Ajax_Handler {
   public static function ajax_handler() {
    global $wpdb;
    parse_str($_REQUEST["data"], $newArr);
    //Handle CRUD for my book
    include_once PLUGIN_PATH . "/lib/my-book.php";
    //Handle CRUD for my authors 
    include_once PLUGIN_PATH . "/lib/my-author.php";
    //Handle CRUD for my students 
    include_once PLUGIN_PATH . "/lib/my-student.php";
   } 
}