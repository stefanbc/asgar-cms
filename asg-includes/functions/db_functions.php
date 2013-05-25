<?php
    /**
     * This file contains all the db functions that Asgar uses.
     *
     * @package Asgar
     */

    // Setup the connection and choose the databse
    function asg_db_connect() {
        $con = new mysqli(DB_SERVER, DB_USER, DB_PASS, DATABASE);
        if($con->connect_errno > 0){
            die('<br><font color="#000"><b>Unable to connect to database [' . $con->connect_error . '] </b><br><small><font color="#ff0000">[ASGAR STOP]</font></small></font>');
        }
        return $con;
    }

    // Close the connection after each use
    function asg_db_disconnect($con) {
        $con->close();
    }

    // Query stuff from the database
    function asg_db_query($sql) {
        $con = asg_db_connect();
        $result = $con->query($sql);
        if(!$result = $con->query($sql)){
            die('<span class="error">There was an error running the query [' . $con->error . '] <br><small><font color="#ff0000">[ASGAR STOP]</font></small></span>');
        }
        while ($row = $result->fetch_assoc()) {
            $result_array[] = $row;
        }
        $result->free();
        asg_db_disconnect($con);
        return $result_array;
    }

    // Count the rows that result in a query
    function asg_db_num_rows($sql){
        $con = asg_db_connect();
        if(!$result = $con->query($sql)){
            die('<span class="error">There was an error running the query [' . $con->error . '] <br><small><font color="#ff0000">[ASGAR STOP]</font></small></span>');
        }
        if ($result = $con->query($sql)) {
            $row_cnt = $result->num_rows;
            return $row_cnt;
            $result->free();
            $result->close();
        }
        asg_db_disconnect($con);
    }

    // Update stuff in the database
    function asg_db_update($sql){
        $con = asg_db_connect();
        $con->query($sql);
        asg_db_disconnect($con);
    }
    
    // Get loggedin user details
    function asg_user_info($type){
        $username = $_SESSION['username'];
        // Get the user info
        $get_query = asg_db_query("select " . $type . " from " . TABLE_USERS . " where username = '" . $username . "'");
        if(!empty($get_query)) {
            foreach ($get_query as $user) {
                return $user[$type];
            }
        }
    }
?>