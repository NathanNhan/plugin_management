<?php 
/*
 * Plugin Name:       My Book Plugin
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       Handle the basics with this plugin.
 * Version:           1.10.3
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Le Trong Nhan
 * Author URI:        https://author.example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       my-book-plugin
 * Domain Path:       /languages
 */

 defined('ABSPATH') or die('You cannot access directly');
 define('PLUGIN_URL', plugin_dir_url( __FILE__ ));
 define('PLUGIN_PATH', plugin_dir_path( __FILE__ ));


 define('VERSION', '1.0');
 
 if(!class_exists('MyBook')) {
    class MyBook {
        //biến toàn cục wpdb
        private $wpdb;
       
        function __construct() {
            global $wpdb;
            $this->wpdb = $wpdb;
            //Hook chạy hàm load_assets vào hook wp_enqueue_scripts
            add_action('admin_enqueue_scripts', array($this, 'load_assets'));
            //Khởi tạo menu in admin
            add_action('admin_menu', array($this, 'mybook_setting'));
        }
        //Nhúng thư viện scripts và css
        function load_assets() {
            $pages_include = array('list-book','add-book','edit-book','list-authors','add-author','list-students','add-student','course-tracker');
            $currentPage = isset($_GET['page']);

            if(in_array($currentPage, $pages_include)) {
                wp_enqueue_style( 'bootstrap', PLUGIN_URL.'css/bootstrap.min.css', '', VERSION, 'all' );
                wp_enqueue_style( 'datatable', PLUGIN_URL.'css/datatables.min.css', '', VERSION, 'all' );
                wp_enqueue_style( 'notifybar', PLUGIN_URL.'css/jquery.notifyBar.css', '', VERSION, 'all' );
                wp_enqueue_style( 'style', PLUGIN_URL.'css/style.css', '', VERSION, 'all' );
    
                
                wp_enqueue_script('bootstrap.min.js', PLUGIN_URL . 'js/bootstrap.min.js', array('jquery'),  VERSION, true);
                wp_enqueue_script('validation.min.js', PLUGIN_URL . 'js/validate.min.js', array('jquery'),  VERSION,true);
                wp_enqueue_script('datatable.min.js', PLUGIN_URL . 'js/datatables.min.js', array('jquery'), VERSION, true);
                wp_enqueue_script('jquery.notifyBar.js', PLUGIN_URL . 'js/jquery.notifyBar.js', array('jquery'), VERSION, true);
                wp_enqueue_script('script.js', PLUGIN_URL . 'js/script.js', array('jquery'), VERSION, true);
                wp_localize_script("script.js","mybookajaxurl",array(
                    "baseURL" => admin_url("admin-ajax.php")
                ));

            }
        }

        ///Hàm khởi tạo admin menu 
        function mybook_setting() {
            add_menu_page( 'My Book', 'My book', 'manage_options', 'my-book', array($this, 'myBook_html'), '');
            add_submenu_page( 'my-book', 'Book List', 'Book List', 'manage_options', 'list-book', array($this, 'book_list'));
            add_submenu_page( 'my-book', 'Book Add', 'Book Add', 'manage_options', 'add-book', array($this, 'book_add'));
            add_submenu_page( 'my-book', 'Book Edit', 'Book Edit', 'manage_options', 'edit-book', array($this, 'book_edit'));

            add_submenu_page( 'my-book', 'Manage author', 'Manage author', 'manage_options', 'list-authors', array($this, 'list_authors'));
            add_submenu_page( 'my-book', 'Author Add', 'Author Add', 'manage_options', 'add-author', array($this, 'author_add'));

            add_submenu_page( 'my-book', 'Manage Students', 'Manage Students', 'manage_options', 'list-students', array($this, 'list_students'));
            add_submenu_page( 'my-book', 'Add Student', 'Add Student', 'manage_options', 'add-student', array($this, 'add_student'));

            add_submenu_page( 'my-book', 'Course Tracker', 'Course Tracker', 'manage_options', 'course-tracker', array($this, 'manage_courses'));
          
        }
        //Giao diện Authors
        function list_authors () {
            include_once PLUGIN_PATH.'/views/author_list.php';
        }
        function author_add () {
            include_once PLUGIN_PATH.'/views/author_add.php';
        }
        //Giao diện students 
        function list_students() {
            include_once PLUGIN_PATH.'/views/student_list.php';
        }

        function add_student() {
            include_once PLUGIN_PATH.'/views/student_add.php';
        }
        //Giao  diện course tracker
        function manage_courses() {
            include_once PLUGIN_PATH.'/views/courses.php';
        }
        //Giao diện cho trang quản trị (menu chính)
        function myBook_html() {
            echo 'Chào mừng đến với trang quản lý sinh viên';
        }
        //Giao diện hiển thị cho book list 
        function book_list() {
            include_once PLUGIN_PATH.'/views/book_list.php';
        }
        //Giao diện hiển thị cho book add 
        function book_add() {
            include_once PLUGIN_PATH.'/views/book_add.php';
        }
        //Giao diện cho update book
        function book_edit() {
            include_once PLUGIN_PATH.'/views/book_edit.php';
        }
        //Tạo database khi active plugin
        function create_table_plugin_book() {
            require_once ABSPATH . 'wp-admin/includes/upgrade.php';
            include_once PLUGIN_PATH .'/db/create-db.php';
            //Tạo role my book user khi active plugin 
            add_role( 'wp_my_book_user', 'My Book User', array(
                "read" => true
            ) );
        }
        //Xóa table khi deactive plugin
        function drop_table_plugin_book() {
            include_once PLUGIN_PATH . '/db/drop-db.php';  
            //Xóa role my book user khi deactive plugin 
            if(get_role('wp_my_book_user')) {
                remove_role('wp_my_book_user');
            }
                  
        }
       
    }
    //Khởi tạo đối tượng book từ class MyBook
    $book = new MyBook();

    //Tạo database khi un active plugin 
    register_activation_hook( __FILE__, array($book,'create_table_plugin_book') );
    //Xóa database khi un active plugin 
    register_deactivation_hook( __FILE__, array($book,'drop_table_plugin_book' ));

    //AJAX call insert book 
    require_once PLUGIN_PATH . "/inc/Ajax_Handler.php"; 
    //AdJAX for book
    add_action( 'wp_ajax_mybooklibrary', ['Ajax_Handler', 'ajax_handler'] );
    //AJAX for authors
    add_action( 'wp_ajax_myauthor', ['Ajax_Handler', 'ajax_handler'] );
    //AJAX for students 
    add_action('wp_ajax_mystudent', ['Ajax_Handler', 'ajax_handler']);
 }
 