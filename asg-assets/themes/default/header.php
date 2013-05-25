<!doctype html> 
<html>
<head>
<title><?=asg_the_title() . ' | ' . WEBSITE_NAME?></title>

<base href="<?=HTTP . '/'?>">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<meta itemprop="name" content="<?=WEBSITE_NAME?>">
<meta itemprop="description" content="Do you want a Koding invite? Request an invite from the community!">
<meta itemprop="image" content="<?=HTTP.'/'.IMAGES?>profile_pic.png">

<meta property="og:title" content="<?=WEBSITE_NAME?>"/>
<meta property="og:description" content="Do you want a Koding invite? Request an invite from the community!"/>
<meta property="og:image" content="<?=HTTP.'/'.IMAGES?>profile_pic.png"/>

<link href="humans.txt" rel="author">
<link href="https://plus.google.com/106548653223239136460/posts" rel="author">

<!--<link href="http://koding.com/images/favicon.ico" rel="shortcut icon">-->

<link href="//fonts.googleapis.com/css?family=Source+Sans+Pro:300|Open+Sans:600|Roboto:300,400" rel="stylesheet" type="text/css">
<link href="//weloveiconfonts.com/api/?family=entypo" rel="stylesheet" type="text/css">
<link href="<?=THEMES.ACTIVE_THEME.THEME_CSS?>tipsy.css" rel="stylesheet" type="text/css">
<link href="<?=THEMES.ACTIVE_THEME.THEME_CSS?>sharrre.css" rel="stylesheet" type="text/css">
<link href="<?=THEMES.ACTIVE_THEME.THEME_CSS?>style.min.css" rel="stylesheet" type="text/css">
<?php
if(asg_user_role() == 1 && asg_user_loggedin() == true){
    echo '<link href="'.THEMES.ACTIVE_THEME.THEME_CSS.'admin-style.css" rel="stylesheet" type="text/css">';
}
?>
</head>
<body>
    <header>
		<div class="logo" data-url="<?=HTTP?>">
			<span class="tagline"><?=WEBSITE_NAME?></span>
		</div>
        <section>
            <nav>    
                <?php
                    if(isset($asg_auth)){
                        echo asg_get_avatar(asg_user_info('email'),20,true);
                        echo '<span class="nav_item" id="user" data-url="http://koding.com/' . $asg_auth . '">' . asg_user_greeting() . $asg_auth . ' !</span>';
                        if(asg_user_role() == 1) {
                            echo '<span class="nav_item entypo-cog icon-spacer admin-only" id="admin" data-url="admin">admin panel</span>';
                        }
                        echo '<span class="nav_item entypo-user icon-spacer" id="account">account</span>';
                        echo '<span class="nav_item entypo-trophy icon-spacer tooltip" id="badges" original-title="Coming soon!">badges</span>';
                        echo '<span class="nav_item entypo-logout icon-spacer" id="logout">logout</span>';
                    } else {
                        echo '<span class="nav_item entypo-login icon-spacer" id="login">login / create account</span>';
                    }
                ?>
            </nav>
        </section>
	</header>