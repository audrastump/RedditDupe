<?php
	//checking to see if they clicked the logout page
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		session_start();
		//if the username is set, we want to destroy the session
		if (isset($_SESSION['username'])) {
			session_destroy();
		}
	}
	//go back to login
	header('Location: login3.html');
	exit();
	
?>