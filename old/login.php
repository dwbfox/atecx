<?php 

include 'includes/config.php';
include 'includes/twitteroauth/twitteroauth.php';
include 'includes/utils.php';




if (USER::isLoggedIn()) {
	// The user is autenticated	
	// Before we forward the user to their profile page, we must first check to see if they're members
	if (!USER::isMember()) {
		// Check to see if user exists in database
		// user has not registered with ATECX. Take them to the signup page.
		USER::forwardTo(USER::PAGE_SIGN_UP);
	} else {

		// User is a member and correctly authenticated. Take them to their profile.
		USER::forwardTo(USER::PAGE_SIGN_UP);
	}
	

// User has not already authenticated. 
} else {
	try {
		USER::authorizeApp();
	} catch (ATECException $e) {
		die("An error occured while attempting to log you in. Please try again later!");
	}	
}

?>