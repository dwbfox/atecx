<?php
// Fail silently if someone tries to access this page directly
if (!defined('BASEPATH')) exit();

/**
 * Auth.php handles most of the user session processes that take
 * place within ATECX. It also handles the OAuth dance between
 * Twitter and ATECX.
 */
class Auth extends CI_Controller {
	
	public function index() 
	{
		//  the page was accessed without any parameters. 
		redirect('/');
	}
	
	/**
	 * This method handles the data after Twitter forwards the user back to the site
	 */
	public function callback() {

		// First let's check if the user even signed in
		if ($this->input->get('denied')) {
			show_error('You have to sign in before becoming a member of ' . SITE_NAME .'!',200,'Ehem...');
		}
		
		// check to see if Twitter sent us the oAuth tokens successfully
		if (!$this->input->get('oauth_token') || !$this->input->get('oauth_verifier')) {
			
			// Twitter did not send back the OAuth tokens. Something went wrong. 
			redirect('auth/logout');
			
		} else {
			
			// Okay, we got the OAuth Tokens 
			$oauth_token = $this->input->get('oauth_token');
			$oauth_verifier = $this->input->get('oauth_verifier');
			
			$twitter = new TwitterOAuth(CONSUMER,CONSUMER_SECRET,$_SESSION['oauth_token'],$_SESSION['oauth_token_secret']);
			
			// Now that we have the oauth tokens, we can create our access token!
			$access_tokens = $twitter->getAccessToken($oauth_verifier);
			

			$user_data = $twitter->get('account/verify_credentials');
			
			if (!isset($user_data)) {
				show_error('Unable to authenticate you. ' . anchor(base_url(),'Try again.'));
			}
						
			/*
			* Set sessions based on user data. 
			* This is importat because it will also be used
			* if and when the user is forwarded to the sign up page.
			*/
			$_SESSION['screen_name'] = $user_data->screen_name;
			$_SESSION['bio'] = $user_data->description;
			$_SESSION['avatar'] = $user_data->profile_image_url;
			$_SESSION['oauth_user_id'] = $user_data->id;


			// Next we need to check if the user is currently a member
			if (!$this->user_model->isMember($_SESSION['oauth_user_id'])) {
				
				// The user is not a member. Forward to the signup page
				redirect('/signup');
				
			} else {
				// The user is a member. We now sign in our user.
				$_SESSION['signed_in'] = true;
				$_SESSION['screen_name'] = $this->user_model->getScreenameByOAuthID($_SESSION['oauth_user_id']);
				$_SESSION['user_id'] = $this->user_model->getUserIDByScreename($_SESSION['screen_name']);

				// Log the user out if he doesn't exist in the database. Just an extra precaution.
				if (!$_SESSION['user_id']) redirect('auth/logout');

				// Send the user back to their profile
				redirect('/profile/' . $_SESSION['screen_name']);
			}
		}
	}


	function liberateData() 
	{
		if (!is_logged_in()) {
			redirect('/');
		}

		$filename = sprintf('%s_%s_data',$_SESSION['screen_name'],$_SESSION['user_id']);

		$user_data = $this->user_model->liberateUserData($_SESSION['screen_name']);
		header('Content-disposition: attachment; filename="' . $filename .'.xml"');
		header('Content-type: "text/xml"; charset="utf8"');
		echo $user_data;

	}

	public function login()
	{	
		// Check to see if the user is already logged in
		if (is_logged_in()) {
			
			// if so, forward them to their profile page
			redirect('/profile/' . $_SESSION['screen_name']);
			
		} else {
			// They're not logged in. Redirect them to Twitter.
			// The rest of the process will be handled by the callback method
			redirect(getSignInURL() .'&force_login=1');
		}
	}
	
	public function logout()
	{
		// Log the user out. See utils_helper.php for details on log_out();
		log_out();
	}

	
}

?>