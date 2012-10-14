<?php


class Profile extends CI_Controller {
	
	
	public function index() {
		redirect('/');
		
	}
	
	/**
	 * This function remaps the URL structure of codeigniter so that
	 * when the user comes to the site like so http://example.com/profile/screename,
	 * screename is passed off as $screen_name as opposed to an indepdent method. 
	 * Discussion is needed as to whether or not to allow public access to the profile pages.
	 * @link http://codeigniter.com/forums/viewthread/143515/
	 */
	public function _remap($screen_name) {
		$user_info = $this->user_model->getUserInfoAssoc($screen_name);
		
		// invalid screen name supplied
		if ($screen_name === '' ||
			strlen($screen_name) <= 1 ||
			!$user_info) {
			show_error('Sorry, dude! The specified user was not found.',404,'User not found.');
		}
		
		// Include CSS specific to the profile page to the header
		$header['css'] = array('profile');
		$header['page_title'] = $screen_name .'\'s Profile';
		
		// Get information about the user from our model and pass it to the profile view
		$num_projects = '0'; // TODO - Implement create a project functionality
		$watch_list = '0';
		$profs = $this->user_model->getUserProficiencies($screen_name);
		$data['profile'] = array(
			'screen_name' => $screen_name,
			'num_projects' => $num_projects,
			'join_date' => $user_info['join_date'],
			'profs' => $profs
		);
		
		$this->load->view('_template/header',$header);
		$this->load->view('profile_view',$data);
		$this->load->view('_template/footer');
	}
}
