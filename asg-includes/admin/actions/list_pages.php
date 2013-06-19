<h1>Pages</h1>
<?
    $query_pages = asg_db_query("select * from " . TABLE_PAGES);
    
    if (!empty($query_pages)) {
        foreach($query_pages as $page) {
            
            echo $page['ID'] . ' ' . $page['title'] . ' ' . $page['page_author'] . ' ' . $page['date_created'] . '<br>';
            
        }
    } else {
        
        echo 'It appears you haven\'t written anything yet. Why not start now!';
        
    }
?>