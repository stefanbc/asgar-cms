<?php

    // Get the average waiting time for invite query
    $average_time = asg_db_query("select (sum(unix_timestamp(invite_date) - unix_timestamp(date)) / count(*)) as average_time from " . INVITES . " where status = '1' and date >= '2013-01-17 14:00:00' order by date asc");
    
    // Count user for pagination
    $user_count = asg_db_num_rows("select * from " . USERS . "");
    // Count the number of people invited
    $invites_number = asg_db_num_rows("select * from " . INVITES . " where status = '1' order by date asc");
    // Count the number of people in queue
    $queue_number = asg_db_num_rows("select * from " . INVITES . " where status = '0'");
    // Count the number of people invited by the user
    $user_invite_number = asg_db_num_rows("select * from " . INVITES . " where status = '1' and invited_by = '" . $the_user . "' order by date asc");
    
?>