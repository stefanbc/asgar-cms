<?php
    /**
     * Custome theme file.
     *
     * @package default
     */
    
    $custom_title = "Invite Leaderboard";
    
    // header part
    require("header.php");
?>      
    <h1 class="page-title"><?=asg_the_title()?></h1>
    
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
<?php
    // footer part
    require("footer.php");
?>