<?php

include_once 'includes/config.php';
include_once 'includes/utils.php';


if (!USER::isLoggedIn()) {
	// user is attempting to access profile page without logging in, forward them to the login page
	USER::forwardTo(USER::PAGE_LOG_IN);
}

echo 'You are now in yer profile!';

var_dump($_SESSION);
?>
