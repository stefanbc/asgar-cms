<?php
    // The basecamp for our website
    define('HTTP', 'http://stefanbc.koding.com/community');
    
    // The prefix for the main folders and for db tables
    define('FOLDER_PREFIX', 'asg-');
    define('TABLE_PREFIX', 'asg_');
    
    // All the assets
    define('ASSETS', FOLDER_PREFIX . 'assets/');
        define('CSS', ASSETS . 'css/');
        define('IMAGES', ASSETS . 'images/');
        define('JS', ASSETS . 'js/');
            define('MODULES', JS . 'modules/');
            define('JS_ADMIN', JS . 'admin/');
    
    // All the includes
    define('INCLUDES', FOLDER_PREFIX . 'includes/');
        define('ADMIN_INCLUDES', 'admin/');
            define('ADMIN_ACTIONS', ADMIN_INCLUDES . 'actions/');
        define('AJAX', 'ajax/');
        define('FUNCTIONS', 'functions/');
        
    // Database server credentials
    define('DB_SERVER','mysql0.db.koding.com');
    define('DB_USER','stefanbc_43f2da4');
    define('DB_PASS','6f9c99f4346e41c6925b29e06573fd51a0f8ac13');
    define('DATABASE','stefanbc_43f2da4');
    
    // You should change this on each install! Call ?salt=true to generate a new AUTH_SALT
    define('AUTH_SALT','2*W1NJd~Q6$&Pj2L7(-,xi.L@CCr=ns<|=QGX|Fu1lqsj5$^pf.MH1/z><,;ooeu');
?>