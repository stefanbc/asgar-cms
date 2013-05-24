<?php
    
    // Measure page load time
    $time = microtime();
    $time = explode(' ', $time);
    $time = $time[1] + $time[0];
    $start = $time;
    
    // Name the session
    session_name('_kdcp_auth');
    // Start the session
    session_start();
    
    // The user
    $the_user = $_SESSION['username'];
    
    // Master settings
    require(dirname(__FILE__) . '/settings.php');

    // Master configuration
    require(dirname(__FILE__) . '/config.php');
    
    // Filenames
    require(dirname(__FILE__) . '/filenames.php');
    
    // Database tables
    require(dirname(__FILE__) . '/' . TABLES);
    
    // Database functions
    require(dirname(__FILE__) . '/' . FUNCTIONS . DB_FUNCTIONS);
    
    // Output functions
    require(dirname(__FILE__) . '/' . FUNCTIONS . OUTPUT);
    
    // General functions
    require(dirname(__FILE__) . '/' . FUNCTIONS . GENERAL);
    
    // Session functions
    require(dirname(__FILE__) . '/' . FUNCTIONS . SESSION);
    
    // Queries
    require(dirname(__FILE__) . '/' . QUERIES);
        
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

    // Load the theme
    require(dirname(__FILE__) . '/' . THEMES . ACTIVE_THEME . '/index.php');
    
    // Break user records into pages
    $user_pages = ceil($user_count/PAGINATE_NUMBER);
    // Break invites record into pages
    $invite_pages = ceil($queue_number/INVITES_PAGINATE_NUMBER);
?>