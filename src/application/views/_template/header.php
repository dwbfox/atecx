<!doctype html>
<html lang="en">
<head>
	<title><?php echo isset($page_title) ? $page_title . ' - ' . SITE_NAME  : SITE_NAME; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>/css/ui-lightness/jquery-ui-1.8.23.custom.css">
	<link rel="styylesheet" type="text/css" href="<?php echo asset_url(); ?>/fontAwesome/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>/fontAwesome/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>/css/header.css">
	<link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>/css/main.css">
	<?php
	// Inject any custom css if it's passed by our controller
	if (isset($css)) {
		foreach ($css as $stylesheet) {
			echo '<link href="' . asset_url() .'/css/'. $stylesheet. '.css" type="text/css" rel="stylesheet" >';
		}
	}
	?>
</head>
<body>
	<!-- NAV -->
<div id="wrapper" class="container">
	<div class="navbar navbar-inverse navbar-fixed-top">
	  <div class="navbar-inner">
	    <div class="container">
	    	<ul class="nav">
	    		<li>
		    		<a href="<?php echo base_url(); ?>" class="brand"><i class="icon-cogs"></i><?php echo SITE_NAME; ?></a>
		    	</li>
		    	<li><a href="#"><i class="icon-question-sign"></i>About</a></li>
		    	<li><a href="#"><i class="icon-signal"></i>Stats</a></li>
		    </ul>
		    <form class="navbar-search pull-left">  
	  			<input type="text" class="search-query" placeholder="<?php echo 'Search ' . SITE_NAME; ?>">  
			</form>  
			<?php if (is_logged_in()): ?>
			<div class="btn-group pull-right">
			  <a class="btn-dashboard btn dropdown-toggle" data-toggle="dropdown" href="#">
				 <img src="<?php echo twitter_profile_image($_SESSION['screen_name'], 'mini');?>" >
				 <?php echo$_SESSION['screen_name']; ?>

			  </a>
			  <ul class="dropdown-menu">
			    <?php 
		    	 echo '<li><a href="' . base_url(). 'profile/' . $_SESSION['screen_name'] .'" ><i class="icon-user"></i>Dashboard</a></li>';
		    	 echo '<li><a href="'. base_url(). '/signout"><i class="icon-unlock"></i>Sign out</a></li>';
			    ?>
			  </ul>
			</div>
		    <?php else:?>
			<ul class="nav nav-list pull-right">
			<li><a href="login/"><i class="icon-twitter"></i>Sign In</a></li>
			</ul>
			<?php endif; ?>

		   


	    </div><!-- Nav container -->
	  </div>
	</div> 

<!-- END NAV -->
<!-- END GENERATED HEADER-->