<?php


class Profile extends CI_Controller {
	
	/**
	 * This function remaps the URL structure of codeigniter so that
	 * when the user comes to the site like so http://example.com/profile/screnname,
	 * screename is passed off as $screen_name as opposed to an indepdent method. 
	 * @link http://codeigniter.com/forums/viewthread/143515/
	 */
	public function _remap($screen_name) {
		$data['page_title'] = $screen_name .'\'s Profile';
		
		// Get information about the user from our model and pass it to the profile view
		$user_info = $this->user_model->getUserInfoAssoc($screen_name);
		$num_projects = '0'; // TODO - Implement create a project functionality
		$watch_list = '0';
		$profs = $this->user_model->getUserProficiencies($screen_name);
		$data['profile'] = array(
			'num_projects' => $num_projects,
			'join_date' => $user_info['join_date'],
			'profs' => $profs
		);
		
		$this->load->view('_template/header');
		$this->load->view('profile_view',$data);
		$this->load->view('_template/footer');
	}
}