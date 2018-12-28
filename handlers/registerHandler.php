<?php

	function clean($string) {
		return strip_tags($string);
	}

	function clean_name($string) {
		$str = strip_tags($string);
		$string = preg_replace('/\s+/', '', $str);
		return $string;
	}

	if (isset($_POST['registerAdmin']) || isset($_POST['registerStudent'])) {
		$f_name = clean_name($_POST['f_name']);
		$l_name = clean_name($_POST['l_name']);
		$username = clean_name($_POST['username']);

		if (isset($_POST['registerAdmin'])) {
			$faculty_id = clean($_POST['faculty_id']);
		} else {
			$faculty_id = "";
		}

		$dept = clean($_POST['dept']);
		$email = clean($_POST['email']);
		$phone = clean($_POST['phone']);
		$password = clean($_POST['password']);
		$c_password = clean($_POST['c_password']);

		$success = $account->validate($f_name, $l_name, $username, $faculty_id, $dept, $email, $phone, $password, $c_password);

		if ($success) {
			$_SESSION['username'] = $username;
			$_SESSION['mail'] = 0;
			header("Location: index.php");
		} else {
			?>
			<div class="alert alert-success alert-dismissible" id="errorDiv">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Check your form for Errors</strong>
			</div>
			<?php
		}

	}

?>