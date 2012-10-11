<!doctype html>
<html lang="en">
<head>
	<title><?php echo isset($page_title) ? $page_title . ' - ATEC Experimental'  : 'ATEC Experimental'; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>/css/ui-lightness/jquery-ui-1.8.23.custom.css">
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
	<div class="navbar navbar-inverse  navbar-fixed-top">
	  <div class="navbar-inner">
	    <div class="container">
	    	<ul class="nav">
	    		<li>
		    		<a href="<?php echo base_url(); ?>" class="brand">ATEC <strong>Experimental</strong></a>
		    	</li>
		    	<li><a href="#">About</a></li>
		    </ul>
		    <form class="navbar-search pull-left">  
	  			<input type="text" class="search-query" placeholder="Search ATEC Experimental">  
			</form>  
		    <ul class="nav pull-right">
		    	<li>
		    		<?php
		    		if (!is_logged_in()) {
		    			// The user isn't logged. Generate a request URL and get them to sign in.
		    			 echo anchor('login','Sign in or Sign Up');
					} else {
						// The user is logged in. We now get their username and display it.
						$user = $_SESSION['screen_name'];
						echo anchor('profile/' . $user,$user);
					}
					?>
		    	</li>
			</ul>
	    </div><!-- Nav container -->
	  </div>
	</div> 

<!-- END NAV -->
<!-- END GENERATED HEADER-->