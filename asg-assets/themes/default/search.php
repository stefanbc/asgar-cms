<?php
    /**
     * Main search theme file.
     *
     * @package default
     */
        
    $custom_title = 'Search';
    
    // Header
    require("header.php");
?>
    <h1 class="page-title">Search</h1>
<?php 
    
    $search_keyword = $_REQUEST['s'];
    if (!empty($search_keyword)) {
        echo 'Your search keyword is ' . $search_keyword;
    } else {
        echo 'Please enter a keyword first!';
    }
    
?>    
<?php
    // Footer
    require("footer.php");
?>