<?php
    /**
     * This file contains all the theme related functions that Asgar uses.
     *
     * @package Asgar
     */
     
    // Return all themes in the themes folder
    function asg_get_themes(){
        
        $results = scandir(THEMES);
        foreach ($results as $result) {
            if ($result === '.' or $result === '..') continue;
            
            if (is_dir(THEMES . '/' . $result)) {
                echo $result . '<br>';
            }
        }
        
    }

    // Get the theme folder
    function asg_themefolder($type, $path){
        // Relative of absolute path
        // Default false
        switch ($path) {
            case 'true':
                $folder = HTTP . '/' . THEMES . ACTIVE_THEME;
            break;
            default:
                $folder = THEMES . ACTIVE_THEME;
            break;
        }
        switch ($type) {
            case 'css':
                $folder .= THEME_CSS;
            break;
            case 'images':
                $folder .= THEME_IMAGES;
            break;
            case 'js':
                $folder .= THEME_JS;
            break;
            default:
                $folder .= '/';
            break;
        }
        return $folder;
    }

    // Get the requested theme file
    // default is index.php
    function asg_get_themefile(){
        // Get the current page
        $path    = $_SERVER['REQUEST_URI'];
        // Remove any noise and set it as current
        $current = basename($path);
        // Get current page for comparison 
        $url = substr("http" . (($_SERVER['SERVER_PORT'] == 443) ? "s://" : "://") . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], 0, -1);
        if($url == HTTP || $current == HOME_PAGE || $current == BLOG_PAGE || $current == 'index') {
            $file = "index.php";
        } elseif ($current == 'search' || isset($_REQUEST['s'])) {
            $file = "search.php";
        } else {
            $page_query = asg_db_query("select title, custom_link from " . TABLE_PAGES . " where title = '" . $current . "' and status = 'published'");
            if (!empty($page_query)) {
                foreach($page_query as $custom_link){
                    // Request the page name.
                    if($custom_link['custom_link'] != NULL) {
                        $file = $custom_link['custom_link'] . '.php';
                    } else {
                        $file = "index.php";
                    }
                }
            } else {
                $file = "post.php";
            }
        }
        return $file;
    }
    
    // Returns the theme info set in the readme.md file
    // for the active theme
    function asg_get_themeinfo($type){
        $filename = asg_themefolder('',false) . 'readme.md';

        if (file_exists($filename)) {
            // Open the file
            $fp = @fopen($filename, 'r'); 
            // Add each line to an array
            if ($fp) {
               $array = explode("\n", preg_replace('/^[ \t]*[\r\n]+/m', '', fread($fp, filesize($filename))));
            }
            
            switch($type){
                case 'name';
                    $theme_info = trim(substr($array[0],11));
                break;
                case 'uri';
                    $theme_info = trim(substr($array[1],10));
                break;
                case 'author';
                    $theme_info = trim(substr($array[2],7));
                break;
                case 'author_uri';
                    $theme_info = trim(substr($array[3],11));
                break;
                case 'description';
                    $theme_info = trim(substr($array[4],12));
                break;
                case 'version';
                    $theme_info = trim(substr($array[5],8));
                break;
                case 'license';
                    $theme_info = trim(substr($array[6],8));
                break;
                case 'license_uri';
                    $theme_info = trim(substr($array[7],13));
                break;
                case 'slug';
                    $theme_info = trim(substr($array[8],5));
                break;
            }
        } else {
            $theme_info = 'NULL';
        }
        
        return $theme_info;
    }
?>