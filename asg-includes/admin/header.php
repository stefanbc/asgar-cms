<!doctype html> 
<html>
<head>

<title><?=asg_the_title() . ' | ' . WEBSITE_NAME?></title>

<base href="<?=HTTP . '/'?>">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!--<link href="http://koding.com/images/favicon.ico" rel="shortcut icon">-->

<!-- Asgar header scripts -->
<?=asg_scripts('header')?>

</head>
<body>

<!-- Asgar admin bar -->
<?=asg_admin_bar($asg_auth)?>

<!-- page wrapper -->
<div class="page-wrapper">
	<!-- sidebar -->
	<aside class="sidebar-wrapper">
		<h1 class="entypo-cloud-thunder icon-spacer">Admin Panel</h1>
		<!-- main navigation -->
		<div class="admin-navigation-wrapper">
			<?php require(INCLUDES . ADMIN_INCLUDES . FILE_ADMIN_NAVIGATION); ?>
		</div>
		<!-- search form -->
		<div class="search-wrapper">
			<?=asg_search()?>
		</div>
	</aside>
	<!-- begin content -->
	<div class="content-wrapper">