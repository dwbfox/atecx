<?php
// Fail silently if someone tries to access this page directly
if (!defined('BASEPATH')) exit();


class Main extends CI_Controller {
	
	
	public function index() 
	{
		// We first get recently added projects
		$recent_projects = $this->projects_model->getRecentProjects(4);

		$content['recent_projects'] = $recent_projects;
		// This is the home page css
		$header['css'] = array('home');
		
		$footer['js'] = array('home');
		// Load the home page


		$this->load->view('_template/header',$header);
		$this->load->view('home_view',$content);
		$this->load->view('_template/footer',$footer);
		
	}

}
