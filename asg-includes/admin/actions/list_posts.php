<h1>Posts</h1>
<?
    $query_posts = asg_db_query("select * from " . TABLE_POSTS);
    
    if (!empty($query_posts)) {
        foreach($query_posts as $post) {
            
            echo $post['ID'] . ' ' . $post['post_title'] . ' ' . $post['post_author'] . ' ' . $post['post_date'] . '<br>';
            
        }
    } else {
        
        echo 'It appears you haven\'t written anything yet. Why not start now!';
        
    }
?>