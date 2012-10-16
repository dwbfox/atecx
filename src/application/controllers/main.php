<?php


class Main extends CI_Controller {
	
	
	public function index() 
	{
		// This is the home page.
		$header['css'] = array('home');
		
		$footer['js'] = array('home');
		// Load the home page
		$this->load->view('_template/header',$header);
		$this->load->view('home_view');
		$this->load->view('_template/footer',$footer);
		
	}

}
