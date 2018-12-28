<?php 

	if (isset($_POST['loginAdmin']) || isset($_POST['loginStudent'])) {
		$string = strip_tags($_POST['username']);
		$password = strip_tags($_POST['password']);

		$query = "SELECT * FROM users WHERE username='$string' OR faculty_id='$string'";

		$result = mysqli_query($con, $query);

		if (mysqli_num_rows($result) <=0) {
			header("Location: register.php?loginDetails=inv");
		} else if(mysqli_num_rows($result) == 1) {
			$row = mysqli_fetch_array($result);
			// verifying password 

			$pw = $row['password'];
			// $isUser = password_verify($password, $pw);
			$isUser = md5($pw);
			/* $pw = hash from db, $password = what user entered in	form  */

			if ($isUser) {
				$username = $row['username'];
				$_SESSION['username'] = $username;

				// checking for mail verification
				$isVerified = $row['isVerified'];
				$_SESSION['mail'] = $isVerified;

				// checking for remember me button and setting cookie
				if (isset($_POST['rememberLogin'])) {
					$cookie_token = str_shuffle(md5("qpwoeirutylaksjdhggdmznxbcvvpp_+_+_+_+"));
					$UpdateUserSetCookie = mysqli_query($con, "UPDATE users SET cookieToken='$cookie_token' WHERE username='$username'");
					setcookie("cookieToken", $cookie_token, time() + 60*60*24*7);
				}
				
				header("Location: index.php");
			} else {
				header("Location: register.php?loginDetails=inv");
			}

		}
	}


?>