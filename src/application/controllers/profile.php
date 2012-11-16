<?php
// Fail silently if someone tries to access this page directly
if (!defined('BASEPATH')) exit();


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
	public function _remap($screen_name=null) {

		// The user supplied an invalid user
		if ($screen_name === null)
		{
			redirect('auth/logout');
		}
		
		// Check our database to see if the user exists
		$user_info = $this->user_model->getUserInfoAssoc($screen_name);
		
		// The user does not exist. Send the visitor back to the front page
		if ($screen_name === '' || !$user_info) {
			redirect('/');
		}
		
		// Include CSS specific to the profile page to the header
		$header['css'] = array('profile');
		$header['page_title'] = $screen_name .'\'s Profile';
		$footer['js'] = array('profile');
		


		// Get information about the user from our model and pass it to the profile view
		$num_projects = $this->projects_model->getProjectCountForUser($screen_name);
		$profs = $this->user_model->getUserProficiencies($screen_name);
		$project_tiles = $this->projects_model->getProjectInfoByScreename($screen_name);
		
		$data['profile'] = array(
			'bio' => $user_info['bio'],
			'project_tiles' => $project_tiles,
			'screen_name' => $screen_name,
			'num_projects' => $num_projects,
			'join_date' => $user_info['join_date'],
			'profs' => $profs
		);
		
		$this->load->view('_template/header',$header);
		$this->load->view('profile_view',$data);
		$this->load->view('_template/footer',$footer);
	}
}
