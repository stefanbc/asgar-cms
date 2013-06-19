<!doctype html> 
<html>
<head>

<title><?=asg_the_title() . ' | ' . WEBSITE_NAME?></title>

<base href="<?=HTTP . '/'?>">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<meta itemprop="name" content="<?=WEBSITE_NAME?>">
<meta itemprop="description" content="Do you want a Koding invite? Request an invite from the community!">
<meta itemprop="image" content="<?=asg_themefolder('images',true)?>profile_pic.png">

<meta property="og:title" content="<?=WEBSITE_NAME?>"/>
<meta property="og:description" content="Do you want a Koding invite? Request an invite from the community!"/>
<meta property="og:image" content="<?=asg_themefolder('images',true)?>profile_pic.png"/>

<link href="humans.txt" rel="author">
<link href="https://plus.google.com/106548653223239136460/posts" rel="author">
<!--<link href="http://koding.com/images/favicon.ico" rel="shortcut icon">-->

<!-- Asgar header scripts -->
<?=asg_scripts('header')?>
<link href="<?=asg_themefolder('css',false)?>sharrre.css" rel="stylesheet" type="text/css">
<link href="<?=asg_themefolder('css',false)?>style.css" rel="stylesheet" type="text/css">

</head>
<body>
<!-- Asgar admin bar -->
<?=asg_admin_bar($asg_auth)?>
<!-- page wrapper -->
<div class="page-wrapper">
	<!-- sidebar -->
	<aside class="sidebar-wrapper">
		<!-- main navigation -->
		<div class="navigation-wrapper">
			<?=asg_the_nav(0,1)?>
		</div>
		<!-- search form -->
		<div class="search-wrapper">
			<?=asg_search()?>
		</div>
	</aside>
	<!-- begin content -->
	<div class="content-wrapper">