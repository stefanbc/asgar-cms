<?php
    /**
     * Custome theme file.
     *
     * @package default
     */
    
    $custom_title = "Koding Status";

    // header part
    require("header.php");
?>      
    <h1 class="page-title"><?=asg_the_title()?></h1>
    
<?
    $url = 'http://koding.com';
    //make the connection with curl
    $cl = curl_init($url);
    curl_setopt($cl,CURLOPT_CONNECTTIMEOUT,10);
    curl_setopt($cl,CURLOPT_HEADER,true);
    curl_setopt($cl,CURLOPT_NOBODY,true);
    curl_setopt($cl,CURLOPT_RETURNTRANSFER,true);
    
    //get response
    $response = curl_exec($cl);
    
    curl_close($cl);
    
    if ($response) {
        $response = 'Site seems to be up and running!';
    } else {
        $response = 'Oops nothing found, the site is either offline or the domain doesn\'t exist';
    }
    
    echo '<div class="status">' . date('d-m-Y') . ' - ' . $response . '</div>';
?>
<?php
    // footer part
    require("footer.php");
?>