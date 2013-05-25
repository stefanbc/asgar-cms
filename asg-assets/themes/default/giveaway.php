<?php
    /*
    *	Title: Koding Community Platform
	*	Author: Stefan Cosma
	*	Date: 07.12.2012
    *
    *
	*/
        
    // Start platform
    require('asg-includes/asg_start.php');
    
    // Header
    require(INCLUDES . TEMPLATE_TOP);
?>
    <div class="content_wrapper">
        <?=asg_the_nav(0,1);?>

        <? $the_title = "Giveaway an Invite" ?>
                
        <h1><?=asg_the_title()?></h1>
        
        <?php
            // Count invite request for pagination
            $queue_number = asg_db_num_rows("select * from " . TABLE_INVITES . " where status = '0'");
            // Break invites record into pages
            $invite_pages = ceil($queue_number/INVITES_PAGINATE_NUMBER);
        ?>
        <div class="invite_wrapper">
            <div id="invites"></div>
            <?=asg_paginate($invite_pages,'invites')?>
        </div> 
    </div>
    
<?php
    // Footer
    require(INCLUDES . TEMPLATE_BOTTOM);
    
    // Stop platform
    require(INCLUDES . 'asg_stop.php');
?>