<?php
    /**
     * This file loads all the stuff that Asgar needs.
     *
     * @package Asgar
     */
        
    // Master settings
    require(dirname(__FILE__) . '/settings.php');

    // Master configuration
    require(dirname(__FILE__) . '/config.php');
    
    // Filenames
    require(dirname(__FILE__) . '/filenames.php');
    
    // Database tables
    require(dirname(__FILE__) . '/' . FILE_TABLES);
    
    // Database functions
    require(dirname(__FILE__) . '/' . FUNCTIONS . FILE_DB_FUNCTIONS);
    
    // Output functions
    require(dirname(__FILE__) . '/' . FUNCTIONS . FILE_OUTPUT);
    
    // General functions
    require(dirname(__FILE__) . '/' . FUNCTIONS . FILE_GENERAL);
    
    // Session functions
    require(dirname(__FILE__) . '/' . FUNCTIONS . FILE_SESSION);

    // Measure page load time
    $loadtime = asg_loadtime_start();

    // Name the Asgar session
    session_name('_asg_auth');
    // Start the session
    asg_start_session();
    // The Asgar auth main Session variable
    $asg_auth = $_SESSION['username'];
        
    // Generate SALT if requested
    if($_REQUEST['salt']){
        
        echo "Replace line 18 in your settings file with the one below<br><br>";
        echo "define('AUTH_SALT','" . asg_random_gen(64,true) . "');";
        die();
        
    }
    
    // Connect to the database
    $con = asg_db_connect();
    
    // Get the configuration options from the Database
    $get_options_query = asg_db_query("select * from " . TABLE_OPTIONS);
    
    // Get the options values
    foreach($get_options_query as $option){
        
        define($option['option'], $option['value']);
        
    }

    // Load the active theme if it's not called by an ajax script
    if ($load_theme != false) {
        require(dirname(__DIR__) . '/' . THEMES . ACTIVE_THEME . '/index.php');
    }
?>