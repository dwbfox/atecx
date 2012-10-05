<?php

include_once 'config.php';
include_once 'database.php';
include_once 'twitteroauth/twitteroauth.php';

session_start();

class ATECException extends Exception {}

class USER extends database {
	const PAGE_SIGN_UP = 'signup.php';
	const PAGE_LOG_IN = 'login.php';
	const PAGE_CALLBACK = 'callback.php';
	const PAGE_HOME = 'index.php';
	const PAGE_404 = '404.php';
	const PAGE_PROFILE = 'profile.php';
	
	
	public static function authorizeApp() {
		
		// Setup OAuth Request
		$twitter = new TwitterOAuth(CONSUMER_KEY,CONSUMER_SECRET);
		$request_token = $twitter->getRequestToken(OAUTH_CALLBACK);

		// Save request token session
		$_SESSION['oauth_token'] = $request_token['oauth_token'];
		$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
		
		// An error occured when contacting Twitter
		if ($twitter->http_code != 200) {
			throw new ATECException("Check if the consumer keys are correct");
		}
		
		// Now that we have the request token, we can forward the user to authorize our app
		// They will then be sent back to our callback handler (OAUTH_CALLBACK)
		$authorization_url = $twitter->getAuthorizeURL($request_token['oauth_token']);
		USER::forwardTo($authorization_url);

	}
	
	
	public static function receivedAuthData() {
		if (!empty($_GET['oauth_token']) && !empty($_GET['oauth_verifier']) && !empty($_SESSION['oauth_token_secret'])) {
			return true;
		} else {
			return false;
		}
	}

	
	public static function logOut() {
		session_destroy();
		USER::forwardTo(USER::PAGE_HOME);
	}
	
	public static function isLoggedIn() {
		return false;
	}
	
	public static function isMember() {
		if (USER::isLoggedIn()) {
			// Check to see if they're in DB
		}
		return true;
	}
	
	public static function addNewUser($data) {
		
	}
	
	public static function forwardTo($page) {
		header("Location: " . $page);
	}
	

}



?>