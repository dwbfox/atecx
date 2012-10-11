<?php 
/**
 * ATEC Experimental
 */
 
include 'application/libraries/twitteroauth/twitteroauth.php';
session_start();

/**
 * Gets the initial request url forwarded to the user so
 *  they can sign in and authorize our app
 * @return [String] a valid URL to Twitter's request page
 */
function getSignInURL() {
	$twitter = new TwitterOAuth(CONSUMER,CONSUMER_SECRET);
	
	// First, let's get our request token to build the request URL
	$request_token = $twitter->getRequestToken('http://foxserv.us.to/atecx/callback');
	
	// Something went wrong when getting the request tokens
	if ($twitter->http_code !== 200) {
		show_error('Something went wrong when attempting to sign you in. Please try again later.');
		return false;
	}
	
	$_SESSION['oauth_token'] = $request_token['oauth_token'];
	$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
		
	// success. return the url
	$request_url = $twitter->getAuthorizeURL($request_token['oauth_token']);
	return $request_url;
}


?>
