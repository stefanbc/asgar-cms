<!doctype html> 
<html>
<head>

<title>Asgar Admin Panel</title>

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
	<!-- begin content -->
	<div class="content-wrapper">