<?php
	/*
	*	Title: Koding Community Platform
	*	Author: Stefan Cosma
	*	Date: 07.12.2012
    *   Available parameters: inviteList
    *
    *   inviteList  - shows directly the invite list
    *
	*/
        
    // Start platform
    require('asg-includes/asg_start.php');
    
    // Check if user is admin
    asg_redirect_user();
    
    // Header
    require(INCLUDES . TEMPLATE_TOP);
?>
    <div class="content_wrapper">
        <!-- page title -->
        <h1><?=asg_the_title()?></h1>
        <!-- page content -->
        <?=asg_the_content()?>
    </div>
    
<?php
    // Footer
    require(INCLUDES . TEMPLATE_BOTTOM);
    
    // Stop platform
    require(INCLUDES . 'asg_stop.php');
?>