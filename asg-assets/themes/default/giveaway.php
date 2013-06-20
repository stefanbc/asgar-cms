<?php
    /**
     * Custome theme file.
     *
     * @package default
     */
    
    $custom_title = "Giveaway an Invite";

    // header part
    require("header.php");
?>      
    <h1 class="page-title"><?=asg_the_title()?></h1>
    
    <?php
        // Count invite request for pagination
        $queue_number = asg_db_num_rows("select * from " . TABLE_INVITES . " where status = '0'");
        // Break invites record into pages
        $invite_pages = ceil($queue_number/INVITES_PAGINATE_NUMBER);
    ?>
    <div class="invite_wrapper">
        <?=asg_paginate($invite_pages,'invites')?>
    </div>
<?php
    // footer part
    require("footer.php");
?>