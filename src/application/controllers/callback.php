<?php

class Callback extends CI_Controller {
	
	
	public function index() 
	{
		// First check to see if Twitter sent us the oAuth data successfully
		if (!$this->input->get('oauth_token') || !$this->input->get('oauth_verifier')) {
			
			// Twitter did not send back the OAuth data.
			show_error('Unable to authenticate you. ' . anchor(base_url(),'Try again.'));
			
		} else {
			
			$oauth_token = $this->input->get('oauth_token');
			$oauth_verifier = $this->input->get('oauth_verifier');
			
			$twitter = new TwitterOAuth(CONSUMER,CONSUMER_SECRET,$_SESSION['oauth_token'],$_SESSION['oauth_token_secret']);
			
			// Now that we have the oauth tokens, we can create our access token!
			$access_tokens = $twitter->getAccessToken($oauth_verifier);
			
			$user_data = $twitter->get('account/verify_credentials');
			
			if (isset($user_data->error)) {
				show_error('Unable to authenticate you. ' . anchor(base_url(),'Try again.'));
				var_dump($this->input->get());
			}
						
			// We got access to the user's data!
			$_SESSION['screen_name'] = $user_data->screen_name;
			$_SESSION['bio'] = $user_data->description;
			$_SESSION['avatar'] = $user_data->profile_image_url;
			
			// Next we need to check if the user is currently a member
			if (!$this->user_model->isMember($_SESSION['screen_name'])) {
				
				// The user is not a member. Forward to the signup page
				redirect('/signup');
				
			} else {
				// We set the user's variables. He/se is now signed in
				$_SESSION['signed_in'] = true;
				// Send the user back to their profile
				redirect('/profile/' . $_SESSION['screen_name']);
			}
		}
	}
}


?>