<?php

    /*
    * The prefix for the main folders and for db tables
    * You shouldn't change these!
    */
    define('FOLDER_PREFIX', 'asg-');
    define('TABLE_PREFIX', 'asg_');
    
    /*
    * The assets
    */
    define('ASSETS', FOLDER_PREFIX . 'assets/');
        define('THEMES', 'themes/');
            define('THEME_CSS', 'css/');
            define('THEME_IMAGES', 'images/');
            define('THEME_JS', 'js/');
                define('THEME_JS_MODULES', 'modules/');
        define('UPLOADS', 'uploads/');
    
    /*
    * The includes
    */
    define('INCLUDES', FOLDER_PREFIX . 'includes/');
        /*
        * The admin includes
        */
        define('ADMIN_INCLUDES', 'admin/');
            define('ADMIN_ACTIONS', ADMIN_INCLUDES . 'actions/');
            define('ADMIN_ASSETS', ADMIN_INCLUDES . 'assets/');
                define('ADMIN_ASSETS_CSS', ADMIN_ASSETS . 'css/');
                define('ADMIN_ASSETS_IMAGES', ADMIN_ASSETS . 'images/');
                define('ADMIN_ASSETS_JS', ADMIN_ASSETS . 'js/');
            define('ADMIN_EDITOR', ADMIN_INCLUDES . 'editor/');
        /*
        * The other includes
        */
        define('AJAX', 'ajax/');
        define('FUNCTIONS', 'functions/');
?>