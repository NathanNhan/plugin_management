<?php 
$this->wpdb->query("DROP TABLE IF EXISTS `wp_my_books`");
$this->wpdb->query("DROP TABLE IF EXISTS `wp_my_authors`");
$this->wpdb->query("DROP TABLE IF EXISTS `wp_my_students`");
$this->wpdb->query("DROP TABLE IF EXISTS `wp_my_enroll`");