<?php



define('CONSUMER','JqREbOjNdtCGcW2Pijzyyg');
define('CONSUMER_SECRET','Jab8uPyIAXmyagwisrVFPFo6mHJaTjbyVOzzn3UwJg');






function asset_url() {
	return base_url() . 'assets';
}


/**
 * Points to the avatar image url of the specified user
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
 */
function log_out() {
	session_destroy();
	redirect('/');
}




?>
