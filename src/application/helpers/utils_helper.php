<?php
// Fail silently if someone tries to access this page directly
if (!defined('BASEPATH')) exit();


define('CONSUMER','JqREbOjNdtCGcW2Pijzyyg');
define('CONSUMER_SECRET','Jab8uPyIAXmyagwisrVFPFo6mHJaTjbyVOzzn3UwJg');
define('SITE_NAME','ATEC Experimental'); // Displayed on header.php
define('CALLBACK_URL','http://localhost/atecx/src/auth/callback'); // the callback URL for Twitter's OAuth
define('PROJECT_IMAGES_FOLDER','appData/project_data/project_images');
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
 * @param [String] $twitter_id  A valid Twitter screen_name or twitter id
 * @param [String] $size A valid avatar size, either bigger, normal, mini, or original
 * @return [String] A URL pointing to the user's avatar image
 * @link https://dev.twitter.com/docs/api/1/get/users/profile_image/%3Ascreen_name
 */
function twitter_profile_image($twitter_id,$size) {
	return 'https://api.twitter.com/1/users/profile_image?id=' . $twitter_id .'&size=' . $size;
}


/**
* Checks to see whether the current user is logged in
* @return [Bool] True if the user is logged in, false if it's not
*/
function is_logged_in() 
{
	if (!isset($_SESSION['oauth_user_id']) || !isset($_SESSION['signed_in'])) {
			return false;
	} else {
		return true;
	}
}

function is_project_member($project_id)
{
	if (!is_logged_in()) {
		return false;
	}

	$CI =& get_instance();
	return $CI->projects_model->isUserMember($_SESSION['screen_name'],$project_id);
}


/**
 * Destroys all user session data and logs out the user
 * @return None
 */
function log_out() {
	session_destroy();
	redirect('/');
}




?>
