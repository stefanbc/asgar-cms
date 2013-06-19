<?php
    /**
     * This file defines all the important db tables,
     * and also defines the optional ones.
     *
     * You can define custom tables here.
     *
     * @package Asgar
     */
    // Options
    define('TABLE_OPTIONS', TABLE_PREFIX . 'options');
    
    // User table
    define('TABLE_USERS', TABLE_PREFIX . 'users');
    
    // Pages and posts
    define('TABLE_PAGES', TABLE_PREFIX . 'pages');
    define('TABLE_POSTS', TABLE_PREFIX . 'posts');
    
    // Custom table Invites
    define('TABLE_INVITES', TABLE_PREFIX . 'invites');    
?>