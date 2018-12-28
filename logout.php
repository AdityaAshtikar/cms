<?php 

	include("includes/config.php");
	if(!checkSession('username')) {
		header("Location: register.php?login=inv");
	}

	if (session_destroy()) {
		if (isset($_COOKIE['cookieToken'])) {
			$cookieToken = $_COOKIE['cookieToken'];
			setcookie('cookieToken', $cookieToken, time() - 365*24*60*60);
		}
		header("Location: register.php");
	}

?>