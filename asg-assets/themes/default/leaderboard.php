<?php
    /**
     * Custome theme file.
     *
     * @package default
     */
    
    $custom_title = "Invite Leaderboard";
    
    // Header
    require("header.php");
?>
    <div class="content_wrapper">
        <?=asg_the_nav(0,1);?>
                
        <h1><?=asg_the_title()?></h1>
        
        <?php
            // Count user for pagination
            $user_count = asg_db_num_rows("select * from " . TABLE_USERS . "");
            // Break user records into pages
            $user_pages = ceil($user_count/PAGINATE_NUMBER);
        ?>
        <div class="second_wrapper">
            <div id="leaderboard"></div>
            <?=asg_paginate($user_pages,'leaderboard')?>
        </div>
    </div>
    
<?php
    // Footer
    require("footer.php");
?>