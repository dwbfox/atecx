<?php
// Fail silently if someone tries to access this page directly
if (!defined('BASEPATH')) exit();

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

      }
    
    public function index()
      {
        // Make sure the proper credentials are set
        
        
        // Add relevant CSS and data to the header
        $header['css']  = array('signup');
        $header['page_title'] = 'Sign up';

        $content['prof_roles']['animation'] = $this->user_model->getProficiencyRoles('animation');
        $content['prof_roles']['game_design'] = $this->user_model->getProficiencyRoles('Game Design');
        $content['prof_roles']['interactive'] = $this->user_model->getProficiencyRoles('interactive/Web');

        
		    // Add relevant JavaScript files to the footer
		    $footer['js'] = array('signup');
		
        // Load the home page
        $this->load->view('_template/header', $header);
        $this->load->view('signup_view',$content);
        $this->load->view('_template/footer',$footer);
      }
    
    
    public function create()
      {

        // Make sure the user has first signed in with twitter
        // This data is first set by auth.php
        if (!isset($_SESSION['bio']) ||
           !isset($_SESSION['oauth_user_id']) ||
           !$this->input->post('userData'))
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
          	// User created their account. Sign them in.
          	$_SESSION['signed_in'] = true;
            $_SESSION['screen_name'] = $userData['screen_name'];
            die(var_dump($createData));
          }
      }
  }

?>