<?php
    /**
     * This file has all the sessions functions for Asgar.
     *
     * @package Asgar
     */
    // Check if user is logged in
    function asg_user_loggedin(){          
        if(empty($_SESSION['username'])){
            return false;
        } else {
            return true;
        }
    }
    
    // Start a session
    function asg_start_session(){
        return session_start();
    }
    
    // Destroy a session
    function asg_destroy_session(){
        return session_destroy();
    }
    
    // Unset all session variables
    function asg_unset_session(){
        return session_unset();
    }
?>