<?php 
	use PHPMailer\PHPMailer\PHPMailer;

	class Account {
		private $con;
		private $errors;

		public function __construct($con) {
			$this->con = $con;
			$this->errors = array();
		}

		public function validate($fn, $ln, $un, $f_id, $dept, $em, $phone, $pw1, $pw2) {
			$this->checkName($fn);
			$this->checkName($ln);
			$this->checkUserName($un);
			if (!empty($f_id)) {
				$this->checkFID($f_id);
			}
			// $dept = $this->checkDept($dept);
			$this->checkEmail($em);
			$this->checkPhone($phone);
			$this->checkPassword($pw1, $pw2);

			if (empty($this->errors)) {
				// insert user
				return $this->insertUser($fn, $ln, $un, $f_id, $dept, $em, $phone, $pw1);
			} else {
				return false;
			}
		}

		// inserts and sends email
		private function insertUser($fn, $ln, $un, $f_id, $dept, $em, $phone, $pw1) {
			// $pw = password_hash($pw1, PASSWORD_BCRYPT);
			$pw = md5($pw1);
			$tokenString = "qwertyuioplkjghfdaszcxvbbbnmpllpp'_+_+=-";
			$token = str_shuffle(md5($tokenString));
			$profilePic = "assets/images/profilePic/default.png";
			$isVerified = 0;
			$created = date('Y-m-d h:i:s');
			include 'PHPMailer/PHPMailer.php';
			include 'PHPMailer/Exception.php';
			$mail = new PHPMailer();
			$mail->setFrom("ashtikar.aditya97@gmail.com");
			$mail->addAddress($em, $un);
			$mail->Subject = "Verify your email for the college website";
			$mail->isHtml(true);
			$mail->Body = "
				Please Click the link below<br><br>
				<a href='http://localhost/cms/confirm.php?email=$em&token=$token'>Click Here</a>
			";
			if ($mail->send()) {
				$sent = true;
			} else {
				header("Location: register.php?mail=notSent");
				die();
			}
			if($sent == true) {
				if (!empty($f_id)) {
					$isfaculty = 1;
					$insert = mysqli_query($this->con, "INSERT INTO users (firstName, lastName, username, department, email, phone, password, faculty_id, is_faculty, profile_pic, isVerified, token, created) VALUES ('$fn', '$ln', '$un', '$dept', '$em', '$phone', '$pw', '$f_id', 1, '$profilePic', $isVerified, '$token', '$created')");
				} else {
					$isfaculty = 0;
					$insert = mysqli_query($this->con, "INSERT INTO users (firstName, lastName, username, department, email, phone, password, faculty_id, is_faculty, profile_pic, isVerified, token, created) VALUES ('$fn', '$ln', '$un', '$dept', '$em', '$phone', '$pw', '', 0, '$profilePic', $isVerified, '$token', '$created')");
				}
			}
			if ($insert) {
				return true;
			} else {
				return false;
			}
		}

		// to be used in form
		public function getErrors($error) {
			if (!in_array($error, $this->errors)) {
				$error = "";
			} else {
				return "<span style='color: red;'>$error</span><br>";
			}
		}

		private function checkName($string) {
			// length
			if (strlen($string) <=2 || strlen($string) >= 60) {
				array_push($this->errors, Constants::$nmLength);
				return;
			}
		}

		private function checkUserName($string) {
			// length
			if (strlen($string) <=2 || strlen($string) >= 60) {
				array_push($this->errors, Constants::$nmLength);
				return;
			}

			// pattern
			if (!preg_match('/[A-Za-z]/', $string)) {
				array_push($this->errors, Constants::$onlyLettersAllowed);
				return;
			}

			// already exists
			$result = mysqli_query($this->con, "SELECT username FROM users WHERE username='$string'");
			if (mysqli_num_rows($result)) {
				array_push($this->errors, Constants::$unExists);
				return;
			}
		}

		private function checkFID($fid) {
			// already exists
			$result = mysqli_query($this->con, "SELECT faculty_id FROM users WHERE faculty_id='$fid'");
			if (mysqli_num_rows($result) >0) {
				array_push($this->errors, Constants::$fidExists);
				return;
			}
		}

		private function checkEmail($string) {
			// length
			if (strlen($string) <11) {
				array_push($this->errors, Constants::$emLength);
				return;
			}

			// valid email address
			if (!filter_var($string, FILTER_VALIDATE_EMAIL)) {
				array_push($this->errors, Constants::$emLength);
				return;
			}

			// already exists
			$result = mysqli_query($this->con, "SELECT email FROM users WHERE email='$string'");
			if (mysqli_num_rows($result) >0) {
				array_push($this->errors, Constants::$emExists);
				return;
			}

			$matchRes = mysqli_query($this->con, "SELECT email FROM emails WHERE email='$string'");
			if (mysqli_num_rows($matchRes) <=0) {
				array_push($this->errors, Constants::$mailNotReg);
				return;
			}
		}

		private function checkPhone($string) {
			// length
			if (strlen($string)!=10) {
				array_push($this->errors, Constants::$phoneInv);
				return;
			}

			// only numbers
			if (!preg_match('/[0-9]/', $string)) {
				array_push($this->errors, Constants::$phoneInv);
				return;
			}
		}

		private function checkPassword($pw1, $pw2) {
			// checking if the paswords match
			if ($pw1 != $pw2) {
				array_push($this->errors, Constants::$pwDontMatch);
				return;
			}

			// checking if the password contains anything other than A-Z or a-z or 0-9
			if (!preg_match('/[A-Za-z0-9]/', $pw1)) {
				array_push($this->errors, Constants::$pwOnlyNumbersOrLetters);
				return;
			}

			// checking if length is atleast 8
			if (strlen($pw1)<8) {
				array_push($this->errors, Constants::$pw8chars);
				return;
			}
		}

	}

?>