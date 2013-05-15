<!doctype html> 
<html>
<head>
<title>Koding Community Platform</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta itemprop="name" content="Koding Community Platform">
<meta itemprop="description" content="Do you want a Koding invite? Do you have a Koding app idea? Request an invite from the community or submit your idea here and get funding from Koding!">
<meta itemprop="image" content="<?=HTTP.'/'.IMAGES?>profile_pic.png">
<meta property="og:title" content="Koding Community Platform"/>
<meta property="og:description" content="Do you want a Koding invite? Do you have a Koding app idea? Request an invite from the community or submit your idea here and get funding from Koding!"/>
<meta property="og:image" content="<?=HTTP.'/'.IMAGES?>profile_pic.png"/>
<meta name="google-site-verification" content="PDzEBVk5-4hNKeHdm8NjysfdNr9B9JAcUaWtPc-gQuc" />
<meta name="msvalidate.01" content="E77A9E64647184C24D4C1BA0F748846B" />
<link href="humans.txt" rel="author">
<link href="http://koding.com/images/favicon.ico" rel="shortcut icon">
<link href="//fonts.googleapis.com/css?family=Source+Sans+Pro:300|Open+Sans:600|Roboto:300,400" rel="stylesheet" type="text/css">
<link href="//weloveiconfonts.com/api/?family=entypo" rel="stylesheet" type="text/css">
<link href="<?=CSS?>tipsy.css" rel="stylesheet" type="text/css">
<link href="<?=CSS?>sharrre.css" rel="stylesheet" type="text/css">
<link href="<?=CSS?>style.min.css" rel="stylesheet" type="text/css">
<?php
if(asg_user_role() == 1 && asg_user_loggedin() == true){
    echo '<link href="' . CSS . 'admin-style.css" rel="stylesheet" type="text/css">';
}
?>
</head>
<body>
    <header>
		<div class="logo" data-url="<?=HTTP?>">
			<span class="tagline">Community Platform</span>
		</div>
        <section>
            <nav>    
                <?php
                    if(isset($the_user)){
                        echo asg_get_avatar(asg_user_info('email'),20,true);
                        echo '<span class="nav_item" id="user" data-url="http://koding.com/' . $the_user . '">' . asg_user_greeting() . $the_user . ' !</span>';
                        if(asg_user_role() == 1) {
                            echo '<span class="nav_item entypo-cog icon-spacer admin-only" id="admin" data-url="admin">admin panel</span>';
                            echo '<span class="nav_item entypo-rss icon-spacer" id="blog" data-url="blog">blog</span>';
                        }
                        echo '<span class="nav_item entypo-user icon-spacer" id="account">account</span>';
                        echo '<span class="nav_item entypo-trophy icon-spacer tooltip" id="badges" original-title="Coming soon!">badges</span>';
                        echo '<span class="nav_item entypo-info icon-spacer" id="disclaimer">read.me</span>';
                        echo '<span class="nav_item entypo-logout icon-spacer" id="logout">logout</span>';
                    } else {
                        echo '<span class="nav_item entypo-info icon-spacer" id="disclaimer">read.me</span>';
                        echo '<span class="nav_item entypo-login icon-spacer" id="login">login / create account</span>';
                    }
                ?>
            </nav>
        </section>
        <?php
            if(asg_is_page(BLOG_PAGE)) {
                asg_the_nav(0,1);
            }
        ?>
	</header>