<?
    echo '<h1>Edit Post</h1>';
    
    $post_query = asg_db_query("select * from " . TABLE_POSTS . " where ID = '" . $_REQUEST['post_id'] . "'");
    
    if(!empty($post_query)){
        foreach($post_query as $post){
            echo $post['post_title'] . "\n\r";
            echo $post['post_author'] . "\n\r";
            echo $post['post_content'] . "\n\r";
            echo $post['post_status'] . "\n\r";
            echo $post['post_date'] . "\n\r";
            echo $post['comment_status'] . "\n\r";
        }
    } else {
        echo 'The post has not been found!';
    }
    
?>