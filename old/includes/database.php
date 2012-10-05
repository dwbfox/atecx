<?php

include_once 'utils.php';

class UserDB {
	
	public $id;
	public $username;
	public $bio;
	public $oauth_token;
	public $oauth_secret;
	public $email;
	public $joinDate;
	public $interests;
	
}

class database {
	
	public $conn;
	
	public function __construct() {

	}
}


?>
