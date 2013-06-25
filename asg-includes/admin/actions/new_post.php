<?

	echo '<h1>New Post</h1>';

	$post_title = '';
	$post_content = '';
	$post_status = '';
	$post_comments_status = '';
	$post_type = '';
	$post_date = '';
    
    echo '<div class="spacer2 block_wrapper">';
        echo '<div class="settings_value left">';
            echo '<input type="text" class="input" name="post_title" id="post_title" placeholder="Post Name">';
        echo '</div>';
    echo '</div>';
	echo '<textarea id="editor" name="post_content"></textarea>';
?>
