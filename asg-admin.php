<?php
    /*
	*	Title: Koding Community Platform
	*	Author: Stefan Cosma
	*	Date: 07.12.2012
    *
    *
	*/
    
    $disallow_theme = true;

    // Start platform
    require('asg-includes/asg_start.php');
    
    // Check if user is admin
    asg_redirect_user();

    // Set a custom title for the page
    $custom_title = "Asgar Admin Panel";

    // Header part
    require(asg_themefolder('',false) . 'header.php');
?>
    <h1 class="entypo-cloud-thunder icon-spacer">Asgar Admin Panel</h1>
    
    <!-- ADMIN NAVIGATION -->
    <div class="admin-nav-wrapper">
        <?php require(INCLUDES . ADMIN_INCLUDES . FILE_ADMIN_NAVIGATION); ?>
    </div>
    
    <!-- ADMIN CONTENT -->
    <div class="admin-content-wrapper">
        <?php
            $page = $_REQUEST['page'];
            
            switch($page):
                case 'list_posts':
                    include(INCLUDES . ADMIN_ACTIONS . FILE_ADMIN_ACTION_LIST_POSTS);
                break;
                case 'new_post':
                    include(INCLUDES . ADMIN_ACTIONS . FILE_ADMIN_ACTION_NEW_POST);
                break;
                case 'categories':
                    include(INCLUDES . ADMIN_ACTIONS . FILE_ADMIN_ACTION_CATEGORIES);
                break;
                case 'tags':
                    include(INCLUDES . ADMIN_ACTIONS . FILE_ADMIN_ACTION_TAGS);
                break;
                case 'list_pages':
                    include(INCLUDES . ADMIN_ACTIONS . FILE_ADMIN_ACTION_LIST_PAGES);
                break;
                case 'new_page':
                    include(INCLUDES . ADMIN_ACTIONS . FILE_ADMIN_ACTION_NEW_PAGE);
                break;
                case 'list_users':
                    include(INCLUDES . ADMIN_ACTIONS . FILE_ADMIN_ACTION_LIST_USERS);
                break;
                case 'new_user':
                    include(INCLUDES . ADMIN_ACTIONS . FILE_ADMIN_ACTION_NEW_USER);
                break;
                case 'apperence':
                    include(INCLUDES . ADMIN_ACTIONS . FILE_ADMIN_ACTION_APPERENCE);
                break;
                case 'settings':
                    include(INCLUDES . ADMIN_ACTIONS . FILE_ADMIN_ACTION_SETTINGS);
                break;
                default:
                    include(INCLUDES . ADMIN_ACTIONS . FILE_ADMIN_ACTION_DASHBOARD);
                break;
            endswitch;
        ?>
    </div>    
<?php
    // Footer part
    require(asg_themefolder('',false) . 'footer.php');

    // Stop platform
    require(INCLUDES . 'asg_stop.php');
?>