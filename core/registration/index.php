<?php 
	if (empty($_SESSION['login'])) {
		Registration();
	} else {
		echo file_get_contents(SITE_DIR."template/error/index.html");	
	}
	
	
	function Registration() {
		Template::SetFile(SITE_DIR.'/template/registration/index.html');	
		Template::Combine('registration');
		echo Template::GetPage('registration');
	}
	
	