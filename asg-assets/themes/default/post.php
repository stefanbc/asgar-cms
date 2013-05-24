<?php
    /*
    *    Title: Koding Community Platform
	*	Author: Stefan Cosma
	*	Date: 07.12.2012
    *
    *
	*/
        
    // Start platform
    require('asg-includes/asg_start.php');
    
    $post_query = asg_db_query("select * from " . POSTS . " where post_title = '" . str_replace("_"," ", $_REQUEST['id']) . "' and post_status = 'published'");
    
    if(empty($post_query)){
            $the_title = '404 Article not found';
    } else {
        foreach($post_query as $post){  
            $the_title = $post['post_title'];
        }
    }
    
    // Header
    require(INCLUDES . TEMPLATE_TOP);
?>
    <div class="content_wrapper">
        <?php 
                
            if(empty($post_query)){
                echo '<h1>404 Article not found!</h1>';
                echo 'Unfortunatly the article you are looking for has not been writen yet!';
            } else {
                foreach($post_query as $post){
                
                $the_post = '<div id="post-' . $post['ID'] . '">';
                $the_post .= '<div class="post_title"><h2>' . $post['post_title'] . '</h2></div>';
                $the_post .= '<div class="post_meta"><i>Published on ' . date("h:i a / F j, Y", strtotime($post['post_date'])) . '</i></div>';
                $the_post .= '<div class="post_content">' . $post['post_content'] . '</div>';
                $the_post .= '</div>';
                
                echo $the_post;
                
                }
            }
            
        ?>
    </div>
    
<?php
    // Footer
    require(INCLUDES . TEMPLATE_BOTTOM);
    
    // Stop platform
    require(INCLUDES . 'asg_stop.php');
?>