<?php 
	include('includes/config.php');
	$id = $_GET['id'];
	$username = $_GET['username'];
	echo $username;
	if (!checkSession('username')) {
		header("Location: index.php");
		die();
	} else if ($_SESSION['username'] != $username) {
		header("Location: index.php");
		die();
	}
	
	$res = mysqli_query($con, "DELETE FROM users WHERE id='$id'");
	if ($res) {
		if(session_destroy()) {
			if (isset($_COOKIE['cookieToken'])) {
				$cookieToken = $_COOKIE['cookieToken'];
				setcookie('cookieToken', $cookieToken, time() - 365*24*60*60);
				header("Location: register.php?deleted=true");
			}
		}
	} else {
		echo "<h1>Sorry, Could not delete your Account</h1>";
	}

?>