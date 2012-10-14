<?php


class Signout extends CI_Controller {
	
	public function index()
	{
		log_out();
		redirect('/');
	}
	
}
