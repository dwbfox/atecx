<?php


define('CONSUMER','JqREbOjNdtCGcW2Pijzyyg');
define('CONSUMER_SECRET','Jab8uPyIAXmyagwisrVFPFo6mHJaTjbyVOzzn3UwJg');
define('SITE_NAME','ATEC Experimental'); // Displayed on header.php
define('CALLBACK_URL','http://foxserv.us.to/atecx/src/callback'); // the callback URL for Twitter's OAuth




/**
 * Builds a valid URL to the assets url, where all the CSS, JS, and other 
 * viewer related items are housed
 * @return [String] a URL to the assets folder in ../../assets
 */
function asset_url() {
	return base_url() . 'assets';
}


/**
 * Points to the avatar image url of the specified user.
 * Twitter offers a public API to access users images.
 * 
 * @param [String] $screen_name  A valid Twitter screen_name
 * @param [String] $size A valid avatar size, either bigger, normal, mini, or original
 * @return [String] A URL pointing to the user's avatar image
 * @link https://dev.twitter.com/docs/api/1/get/users/profile_image/%3Ascreen_name
 */
function twitter_profile_image($screen_name,$size) {
	return 'https://api.twitter.com/1/users/profile_image?screen_name=' . $screen_name .'&size=' . $size;
}



function is_logged_in() 
{
	if (!isset($_SESSION['screen_name']) || !isset($_SESSION['signed_in'])) {
			return false;
	} else {
		return true;
	}
}


/**
 * Destroys all user data and logs out the user
 * @return None
 */
function log_out() {
	session_destroy();
	redirect('/');
}




?>
