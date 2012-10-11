<?php


class Main extends CI_Controller {
	
	
	public function index() 
	{
		// Load the home page
		$this->load->view('_template/header');
		$this->load->view('home_view');
		$this->load->view('_template/footer');
		
	}

}
