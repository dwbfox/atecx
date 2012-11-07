<?php


class Account extends CI_Controller {


	public function delete($user_id) 
	{
		// Before removing the user, let's make sure they're logged in first
		if (!is_logged_in()) {
			redirect('/');
		}

		$result = $this->user_model->deleteMember($_SESSION['user_id']);
		var_dump($result);
		var_dump($_SESSION);

		// logout the user now that their data is removed
		redirect('auth/logout');

	}

	    public function create()
      {

      	if (is_logged_in()) {
			redirect('profile');
      	}

        // Make sure the user has first signed in with twitter
        // This data is first set by auth.php
        if (!isset($_SESSION['bio']) || !isset($_SESSION['oauth_user_id']))
          {
            // The user doesn't have the credentials. Make them sign in again.
            redirect('/');
          }
          
        // Recieved user data from server side AJAX
        // We now combine it with existing information
        $userData = $this->input->post('userData');
        
        // Check to see if proficicencies might be null
        
        // This is all the info we need about the user
        $createData = array(
            "email" => $userData['email'] . '@utdallas.edu', // TODO - Verify email
            "screen_name" => $userData['screen_name'],
            "bio" => $userData['bio'],
            "interests" => $userData['interests'],
            "oauth_user_id" => $_SESSION['oauth_user_id']
        );
        
        // Add proficiencies if it's set
        if (isset($userData['proficiencies']))
          {
            $createData['proficiencies'] = $userData['proficiencies'];
          }
        
        // Send it to our model
        $result = $this->user_model->addNewMember($createData);
        
        if (!$result)
          {
            // Something went wrong while adding user to database
            $this->output->set_status_header(500); 
            
          } else {

          	// User created their account. 
          	$_SESSION['signed_in'] = true;
            $_SESSION['screen_name'] = $userData['screen_name'];
            $_SESSION['user_id'] = $result;
          }
      }



}


?>