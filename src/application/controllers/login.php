<?php


class Login extends CI_Controller {
	
	
	public function __construct() {
		parent::__construct();
		
		// Check to see if the user is already logged in
		if (is_logged_in()) {
			
			// if so, forward them to their profile page
			redirect('/profile/' . $_SESSION['screen_name']);
			
		} else {
			// They're not logged in. Redirect them to Twitter.
			// The rest of the process will be handled by the callback controller
			redirect(getSignInURL() .'&force_login=1');
		}
	}

}
