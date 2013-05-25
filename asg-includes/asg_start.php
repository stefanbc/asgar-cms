<?php
    /**
     * This file loads all the stuff that Asgar needs.
     *
     * @package Asgar
     */

    // Measure page load time
    $time = microtime();
    $time = explode(' ', $time);
    $time = $time[1] + $time[0];
    $start = $time;
    
    // Name the Asgar session
    session_name('_asg_auth');
    // Start the session
    session_start();
    
    // The Asgar auth main Session variable
    $asg_auth = $_SESSION['username'];
    
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
        
    // Generate SALT if requested
    if($_REQUEST['salt'] == true){
        
        echo "Replace line 26 in your config file with the one below<br><br>";
        echo "define('AUTH_SALT','" . asg_random_gen(64,true) . "');";
        die();
        
    }
    
    // Connect to the database
    $con = asg_db_connect();
    
    // Get the configuration options from the Database
    $get_options_query = asg_db_query("select * from " . OPTIONS);
    
    // Get the options values
    foreach($get_options_query as $option){
        
        define($option['option'], $option['value']);
        
    }

    // Load the active theme
    require(THEMES . ACTIVE_THEME . '/index.php');
?>