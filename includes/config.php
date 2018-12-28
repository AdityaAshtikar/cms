<?php 

	ob_start();
	session_start();

	$timezone = date_default_timezone_set("Asia/Kolkata");

	$con = mysqli_connect('localhost', 'root', '', 'cms');
	if (mysqli_connect_errno()) {
		echo "<h4>Error connecting to mysql</h4>" . mysqli_connect_errno();
	}

	function checkSession($name) {
		if (isset($_SESSION[$name])) {
			return true;
		} else {
			return false;
		}
	}

?>