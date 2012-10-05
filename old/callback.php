<?php

include 'includes/config.php';
include 'includes/twitteroauth/twitteroauth.php';
include 'includes/utils.php';


// Make sure we got the callback parameters from Twitter
if (USER::receivedAuthData()) {
	
	echo "We're in callback!";

	// We will now make the final request to get the permenent access token
	$twitter = new TwitterOAuth(CONSUMER_KEY,CONSUMER_SECRET,$_SESSION['oauth_token'],$_SESSION['oauth_token_secret']);
	$access_token = $twitter->getAccessToken($_GET['oauth_verifier']);
	// We now have the access_token, giving us access to the user's data! 
	
	$_SESSION['access_token'] = $access_token; // Set access_token session to be used if we decide to create an account
	
	// Now what? We check to see if the user exists within our database. If they don't we forward them to create an account screen
	die("A OK!");
	
} else {
	// callback didn't receive data. 
	USER::forwardTo(USER::PAGE_LOG_IN);
}


?>