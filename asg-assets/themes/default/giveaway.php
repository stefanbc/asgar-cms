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