<?php
    /**
     * This file contains all the output functions that Asgar uses.
     *
     * @package Asgar
     */
    
    // Check redirect user if not admin
    function asg_redirect_user(){
        if(asg_user_info('user_type') == 0) {
            header('Location: ' . HTTP);
        }
    }
    
    // Get user role level
    function asg_user_role(){
        if(asg_user_info('user_type') == 0) {
            return 0;
        } elseif (asg_user_info('user_type') == 1){
            return 1;
        }
    }

    // Paginate function
    function asg_paginate($pages, $name){
        // Create pagination
        if($pages > 1) {
            $pagination    = '';
            $pagination    .= '<ol class="pagination">';
        	for($i = 1; $i <= $pages; $i++) {
        		$pagination .= '<li>';
                    $pagination .= '<span class="link paginate_item" id="' . $i . '-page_' . $name . '">' . $i . '</span>';
                $pagination .= '</li>';
        	}
        	$pagination .= '</ol>';
        }
        return $pagination;
    }

    // Get users gravatar using his email adress
    function asg_get_avatar($email, $s = 50, $img = true, $atts = '') {
        $d = urlencode(HTTP.'/'.IMAGES . 'default_small.png');
        $url = 'http://www.gravatar.com/avatar/';
        $url .= md5( strtolower( trim( $email ) ) );
        $url .= "?s=$s&d=$d";
        if ( $img ) {
            $url = '<img src="' . $url . '"';
            $url .= ' ' . $atts . ' ';
            $url .= ' class="avatar tooltip" original-title="use gravatar.com to set your avatar" alt="User Avatar"/>';
        }
        return $url;
    }

    // It's polite to greet someone when they log in!
    function asg_user_greeting(){        
        // Get the current time
        $now = time();
        $b = time() + 36000; 
        $hour = date("g",$b);
        $m = date ("A", $b);
        if ($m == "AM") {
            if ($hour == 12) {
                $greeting = 'Good evening, ';
            } elseif ($hour < 4) {
                $greeting = 'Good evening, ';
            } elseif ($hour > 3) {
                $greeting = 'Good morning, ';
            }
        } elseif ($m == "PM") {
            if ($hour == 12) {
                $greeting = 'Hello, ';
            } elseif ($hour < 7) {
                $greeting = 'Hello, ';
            } elseif ($hour > 6) {
                $greeting = 'Good evening, ';
            }
        }
        return $greeting;
    }
    
    // Check if current page is given url
    function asg_is_page($page){
        // Get the current page
        $path    = $_SERVER['REQUEST_URI'];
        // Remove any noise and set it as current
        $current = basename($path);
        
        if(strcmp($page, $current) == 0){
            return true;
        } else {
            return false;
        }
    }

    // Load dependencies in each zone in the theme file
    function asg_scripts($zone){
        switch ($zone) {
            case 'header':
                $output = '<link href="//weloveiconfonts.com/api/?family=entypo" rel="stylesheet" type="text/css">' . "\n\r";
                $output .= '<link href="//fonts.googleapis.com/css?family=Source+Sans+Pro:300|Open+Sans:600|Roboto:300,400" rel="stylesheet" type="text/css">';
                $output .= '<link href="' . INCLUDES . CSS . 'asg_style.css" rel="stylesheet" type="text/css">' . "\n\r";
                $output .= '<link href="' . INCLUDES . CSS . 'tipsy.css" rel="stylesheet" type="text/css">' . "\n\r";

                if(asg_user_role() == 1 && asg_user_loggedin() == true && (asg_is_page("asg-admin?page=" . $_REQUEST['page']) || asg_is_page("asg-admin"))){
                    $output .= '<link href="' . INCLUDES . ADMIN_ASSETS_CSS . 'admin-style.css" rel="stylesheet" type="text/css">' . "\n\r";
                }
            break;
            case 'footer':
                if(asg_user_role() == 1 && asg_user_loggedin() == true && asg_is_page("asg-admin?page=" . $_REQUEST['page'])){
                    $output .= '<script src="' . INCLUDES . ADMIN_EDITOR . 'ckeditor.js"></script>' . "\n\r";
                    $output .= '<script type="text/javascript">CKEDITOR.replace("editor");</script>' . "\n\r";
                }

                $output .= '<script src="' . INCLUDES . JS . 'analytics.min.js"></script>' . "\n\r";
                $output .= '<script src="' . INCLUDES . JS . 'require.js"></script>' . "\n\r";
                $output .= "<script type=\"text/javascript\">" . "\n\r";
                    $output .= "require(['" . INCLUDES . JS ."require-config.min'], function(){" . "\n\r";
                        $output .= "\t" . "require(['log','jQuery','modal','tipsy','functions','general']);" . "\n\r";
                    $output .= "});" . "\n\r";
                $output .= "</script>" . "\n\r";
            break;
        }
        return $output;        
    }
    
    // The admin bar at the top
    function asg_admin_bar($user){
        $output  = '<header>' . "\n\r";
            $output .= '<div class="logo" data-url="' . HTTP . '">' . "\n\r";
                $output .= '<span class="tagline">' . WEBSITE_NAME . '</span>'. "\n\r";
            $output .= '</div>' . "\n\r";
            $output .= '<section>' . "\n\r";
            $output .= '<nav>' . "\n\r";
                if(isset($user)){
                    $output .= asg_get_avatar(asg_user_info('email'),20,true) . "\n\r";
                    $output .= '<span class="nav_item" id="user" data-url="http://koding.com/' . $user . '">' . asg_user_greeting() . $user . ' !</span>' . "\n\r";
                    if(asg_user_role() == 1) {
                        $output .= '<span class="nav_item entypo-cog icon-spacer admin-only" id="admin" data-url="admin">admin panel</span>' . "\n\r";
                    }
                    $output .= '<span class="nav_item entypo-user icon-spacer" id="account">account</span>' . "\n\r";
                    $output .= '<span class="nav_item entypo-trophy icon-spacer tooltip" id="badges" original-title="Coming soon!">badges</span>' . "\n\r";
                    $output .= '<span class="nav_item entypo-logout icon-spacer" id="logout">logout</span>' . "\n\r";
                } else {
                    $output .= '<span class="nav_item entypo-login icon-spacer" id="login">login / create account</span>' . "\n\r";
                }
            $output .= '</nav>' . "\n\r";
            $output .= '</section>' . "\n\r";
        $output .= '</header>' . "\n\r";

        return $output;
    }

    // Create multi-level navigation
    function asg_the_nav($parent, $level){
        // Get the current page
        $path    = $_SERVER['REQUEST_URI'];
        // Remove any noise and set it as current
        $current = basename($path);
        $link_query = asg_db_query("select p.ID, p.title, custom_link, sublevel.Count from " . TABLE_PAGES . " p  left outer join (select parent, COUNT(*) as Count from " . TABLE_PAGES . " group by parent) sublevel on p.ID = sublevel.parent where p.parent = " . $parent . " and status = 'published' order by sort ASC");
        echo "<ul class='main-navigation'>";
        if(!empty($link_query)){
            foreach ($link_query as $item) {
                if ($item['Count'] > 0) {
                    echo "<li class='has-submenu'>";
                    if ($item['custom_link'] != NULL){
                        echo "<a ";
                        if( $current == str_replace(" ","_",$item['title']) ) { 
                            echo "class='active' "; 
                        } 
                        echo "href='" . HTTP . '/' . str_replace(" ","_", $item['custom_link']) . "'>" . $item['title'] . "</a>";
                    } else {
                        echo "<a ";
                        if( $current == str_replace(" ","_",$item['title']) ) { 
                            echo "class='active' "; 
                        } 
                        echo "href='" . HTTP . '/' . str_replace(" ","_", $item['title']) . "'>" . $item['title'] . "</a>"; 
                    }
                    asg_the_nav($item['ID'], $level + 1);
                    echo "</li>";
                } elseif ($item['Count'] == 0) {
                    echo "<li>";
                    if ($item['custom_link'] != NULL){
                        echo "<a ";
                        if( $current == str_replace(" ","_",$item['title']) ) { 
                            echo "class='active' "; 
                        } 
                        echo "href='" . HTTP . '/' . str_replace(" ","_", $item['custom_link']) . "'>" . $item['title'] . "</a>";
                    } else {
                        echo "<a ";
                        if( $current == str_replace(" ","_",$item['title']) ) { 
                            echo "class='active' "; 
                        } 
                        echo "href='" . HTTP . '/' . str_replace(" ","_", $item['title']) . "'>" . $item['title'] . "</a>";
                    }
                    echo "</li>";
                } else;
            }
        } else {
            echo "<li><a href=\"/\">home</a><li>";
        }
        echo "</ul>";
    }

    // The search function
    function asg_search(){
        $output  = '<form method="get" action="search" name="search">' . "\n\r";
            $output .= '<input type="text" class="input tooltip" name="s" id="s" placeholder="search" original-title="Search for something!">' . "\n\r";
            $output .= '<button class="button" id="search_button" type="submit">SEARCH</button>' . "\n\r";
        $output .= '</form>' . "\n\r";

        return $output;
    }

    // Show the title for each page
    function asg_the_title(){
        $custom_link_query = asg_db_query("select title, custom_link from " . TABLE_PAGES . " where status = 'published'");
        $url = substr("http" . (($_SERVER['SERVER_PORT'] == 443) ? "s://" : "://") . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], 0, -1);
        foreach($custom_link_query as $custom_link){
            // Request the page name.
            if(isset($_REQUEST["page"])) {
                $page = $_REQUEST["page"];
            } elseif($url == HTTP) {
                $page = HOME_PAGE;
            } elseif($custom_link['custom_link'] != NULL) {
                $page = $custom_link['title'];
            } 
        }
        $title_query = asg_db_query("select title from " . TABLE_PAGES . " where title = '" . str_replace("_"," ",$page) . "' and status = 'published' order by ID");
        if(empty($title_query)) {
            $the_title = "404 Not Found";
        } else {
            foreach ($title_query as $title) {
                $the_title = ucfirst($title['title']);
            }
        }
        
        if(isset($GLOBALS["custom_title"])){
            $the_title = $GLOBALS["custom_title"];
            return $the_title;
        } else {
            return $the_title;
        }
    }

    // Show the content for each page
    function asg_the_content(){
        // Request the page name. Default is home
        $page = isset($_REQUEST["page"]) ? $_REQUEST["page"] : HOME_PAGE;
        $queryPage = asg_db_query("select content from " . TABLE_PAGES . " where title = '" . str_replace("_"," ",$page) . "' and status = 'published' order by ID");
        if(empty($queryPage)) {
            $the_content = "404 Not Found! The page is missing! We'll go look for it!";
        } else {
            if(BLOG_PAGE == $page){
                asg_has_posts();
            } else {
                foreach ($queryPage as $pageContent) {
                    $the_content = $pageContent['content'];
                }
            }
        }
        return $the_content;
    }

    // Check to find active posts and sisplay them on the proper page
    function asg_has_posts(){
        $check_posts_query = asg_db_query("select * from " . TABLE_POSTS . " where post_status = 'published' order by post_date desc");
        foreach($check_posts_query as $post){
            $the_post = '<div id="post-' . $post['ID'] . '">';
            $the_post .= '<div class="post_title"><a href="' . BLOG_PAGE . '/' . str_replace(" ","_",strtolower($post['post_title'])) . '" title="'.$post['post_title'].'"><h2>' . $post['post_title'] . '</h2></a></div>';
            $the_post .= '<div class="post_meta"><i>Published at ' . date("h:i a / F j, Y", strtotime($post['post_date'])) . '</i></div>';
            $the_post .= '<div class="post_excerpt">' . asg_post_excerpt($post['post_content'], EXCERPT_LENGHT, BLOG_PAGE . '/' . str_replace(" ","_",strtolower($post['post_title'])), 'more') . '</div>';
            $the_post .= '</div>';
            echo $the_post;
        }
    }

    // Generate an excerpt for the content using the number of words, an url
    // and some text for the more link
    function asg_post_excerpt($text, $number_of_words, $url, $more){
        $text = strip_tags($text);
        $text = preg_replace("/^\W*((\w[\w'-]*\b\W*){1,$number_of_words}).*/ms", '\\1', $text);
        $excerpt = str_replace("\n", "", $text);
        if( str_word_count($text) == str_word_count($excerpt) ) {
          $excerpt .= '... [<a href="'.$url.'">' . $more . '</a>]';
        }
        return $excerpt;
    }
    
    // Custom function for getting the user title
    function asg_user_title($number){
        if($number >= 0 && $number < 25) { 
            $title = 'Community Private';
        } elseif ($number >= 25 && $number < 50) {
            $title = 'Community Sergeant';
        } elseif ($number >= 50 && $number < 100) {
            $title = 'Community Captain';
        } elseif ($number >= 100 && $number < 200) {
            $title = 'Community General';
        } elseif ($number >= 200) {
            $title = 'Community Guru';
        }
        return $title;
    }
?>