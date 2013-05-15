<?php 
    /*
        Asgar CMS Platform
        
        Author: Stefan Cosma
        Website: https://github.com/stefanbc/Asgar
        
        Copyright 2012 (c) Stefan Cosma
    */
        
    require('ap-includes/app_top.php'); 
    
    $post_query = ap_db_query("select * from " . POSTS . " where post_title = '" . str_replace("_"," ", $_REQUEST['id']) . "' and post_status = 'published'");
    
    if(empty($post_query)){
            $the_title = '404 Article not found';
    } else {
        foreach($post_query as $post){  
            $the_title = $post['post_title'];
        }
    }
        
    require(INCLUDES . 'template_top.php');
    
?>

    <!-- body wrapper -->
    <section class="body">
        
        <!-- header -->
        <?php include(INCLUDES . 'header.php'); ?>
            
        <!-- the content -->
        <section class="content">
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
        </section>
        
    </section>
    
    <!-- footer -->
<?php 
    
    require(INCLUDES . 'template_bottom.php'); 
    
    require(INCLUDES. 'app_bottom.php');
    
?>