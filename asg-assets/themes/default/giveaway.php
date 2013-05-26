<?php
    /**
     * Custome theme file.
     *
     * @package default
     */

    $custom_title = "Giveaway an Invite";

    // Header
    require("header.php");
?>
    <div class="content_wrapper">
        <?=asg_the_nav(0,1);?>
                
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
    require("footer.php");
?>