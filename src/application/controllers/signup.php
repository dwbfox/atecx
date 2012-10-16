<?php

class Signup extends CI_Controller
  {
  	/* 	This constructor method automatically
  	* 	runs the following routine when this controller is accessed.
  	* 	That is, any time the user visits the signup page (/signup), this method is executed
	 * 
	 */
    public function __construct()
      {
      	// Call the parent constructor before 
        parent::__construct();
        
		if (is_logged_in()) {
			redirect('profile');
		}
		
        // Make sure the user has first signed in with twitter
        if (!isset($_SESSION['bio']) || !isset($_SESSION['screen_name']))
          {
            // The user doesn't have the credentials. Make them sign in again.
            redirect('/');
          }
      }
    
    public function index()
      {
        // Make sure the proper credentials are set
        
        
        // Add relevant CSS and data to the header
        $header['css']  = array('signup');
        $header['page_title'] = 'Sign up';
        
		// Add relevant JavaScript files to the footer
		$footer['js'] = array('signup');
		
        // Load the home page
        $this->load->view('_template/header', $header);
        $this->load->view('signup_view');
        $this->load->view('_template/footer',$footer);
      }
    
    
    public function create()
      {
        // Recieved user data from server side AJAX
        // We now combine it with existing information
        $userData = $this->input->post('userData');
        
        // Check to see if proficicencies might be null
        
        // This is all the info we need about the user
        $createData = array(
            "email" => $userData['email'] . '@utdallas.edu', // TODO - Verify email
            "screen_name" => $_SESSION['screen_name'],
            "bio" => $_userData['bio'],
            "interests" => $userData['interests']
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
            echo "Uh oh. Something bad happened and we were unabled to create your account. Please try again later.";
            $this->output->set_status_header(500); 
          } else {
          	// User created their account. Sign them in.
          	$_SESSION['signed_in'] = true;
          }
      }
  }

?>