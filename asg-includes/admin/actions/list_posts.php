<?
	/*
	*	Post listing page	
	*
	*	@package Asgar
	*/

    echo '<h1>Posts</h1>';

    $query_posts = asg_db_query("select * from " . TABLE_POSTS);
   
    echo '<div class="admin-posts-wrapper">';
	    echo '<div class="admin-posts-header-wrapper">';
	    	echo '<div class="admin-posts-header-wrapper-inner">';
	    		echo '<div class="admin-posts-header-col col-id posts-col1">ID</div>';
	    		echo '<div class="admin-posts-header-col col-title posts-col2">Title</div>';
	    		echo '<div class="admin-posts-header-col col-author posts-col3">Author</div>';
	    		echo '<div class="admin-posts-header-col col-date posts-col4">Posted on</div>';
	    		echo '<div class="admin-posts-header-col col-actions posts-col5">Actions</div>';
	    	echo '</div>';
	    echo '</div>';
	    echo '<div class="admin-posts-content-wrapper">';
			if (!empty($query_posts)) {
			    foreach($query_posts as $post) { 
			    	$output_post  = '<div class="admin-post-wrapper" id="post-' . $post['ID'] . '">'; 
					    $output_post .= '<div class="admin-posts-content-col col-id posts-col1">' . $post['ID'] . '</div>';
					    $output_post .= '<div class="admin-posts-content-col col-title posts-col2">' . $post['post_title'] . '</div>';
					    $output_post .= '<div class="admin-posts-content-col col-author posts-col3">' . asg_get_user_info($post['post_author'],'username') . '</div>';
					    $output_post .= '<div class="admin-posts-content-col col-date posts-col4">' . $post['post_date'] . '</div>';
					    $output_post .= '<div class="admin-posts-content-col col-actions posts-col5">
					    	<span id="post-edit" class="post-action entypo-pencil icon_spacer tooltip" original-title="edit"></span>
					    	<span id="post-view" class="post-action entypo-eye icon_spacer tooltip" original-title="view"></span>
					    	<span id="post-delete" class="post-action entypo-trash icon_spacer tooltip" original-title="delete"></span>
					    </div>';
				    $output_post .= '</div>';
				    echo $output_post;
			    }
			} else {
			    echo '<div class="admin-posts-content-notice">It appears you haven\'t written anything yet. Why not start now!</div>';
			}
    	echo '</div>';
    echo '</div>';
?>