<?php
    /**
     * Main post theme file.
     *
     * @package default
     */
    
    $post_query = asg_db_query("select * from " . TABLE_POSTS . " where post_title = '" . str_replace("_"," ", $_REQUEST['post']) . "' and post_status = 'published'");
    
    if(empty($post_query)){
        $custom_title = '404 Article not found';
    } else {
        foreach($post_query as $post){  
            $custom_title = $post['post_title'];
        }
    }
    
    // Header
    require("header.php");
?>
    <?php 
            
        if(empty($post_query)){
            echo '<h1 class="post-title">404 Article not found!</h1>';
            echo 'Unfortunatly the article you are looking for has not been writen yet!';
        } else {
            foreach($post_query as $post){
                $the_post = '<div id="post-' . $post['ID'] . '">';
                    $the_post .= '<div class="post-title"><h2>' . $post['post_title'] . '</h2></div>';
                    $the_post .= '<div class="post-meta"><i>Published on ' . date("h:i a / F j, Y", strtotime($post['post_date'])) . '</i></div>';
                    $the_post .= '<div class="post-content">' . $post['post_content'] . '</div>';
                $the_post .= '</div>';
                
                echo $the_post;
            }
        }
        
    ?>    
<?php
    // Footer
    require("footer.php");
?>