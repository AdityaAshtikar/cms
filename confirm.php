<?php 

	include("includes/config.php");

	function redirect() {
		header("Location: register.php");
		exit();
	}

	if (!isset($_GET['email']) || !isset($_GET['token'])) {
		redirect();
	} else {
		$email = strip_tags($_GET['email']);
		$token = strip_tags($_GET['token']);

		$result = mysqli_query($con, "SELECT id FROM users WHERE email='$email' AND token='$token' AND isVerified=0");

		if (mysqli_num_rows($result) <=0) {
			redirect();
		} else {
			$update = mysqli_query($con, "UPDATE users SET isVerified=1, token='' WHERE email='$email'");
			if ($update) {
				$_SESSION['mail'] = 1;
				header("Location: index.php");
			}
		}
	}


?>