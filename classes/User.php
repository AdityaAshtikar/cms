<?php 

	class User {

		private $pic;
		public $is_CR;
		public $is_HOD;
		public $is_faculty;
		private $faculty_id;
		private $firstName;
		private $lastName;
		private $id;
		private $dept;
		private $created;
		private $username;
		private $email;
		private $phone;

		public function __construct($con, $username) {
			$result = mysqli_query($con, "SELECT * FROM users WHERE username='$username'");

			$row = mysqli_fetch_array($result);

			$this->pic = $row['profile_pic'];
			$this->is_faculty = $row['is_faculty'];
			$this->is_HOD = $row['is_HOD'];
			$this->is_CR = $row['is_CR'];
			$this->firstName = $row['firstName'];
			$this->lastName = $row['lastName'];
			$this->id = $row['id'];
			$this->dept = $row['department'];
			$this->email = $row['email'];
			$this->phone = $row['phone'];
			$this->created = $row['created'];
			$this->username = $username;
			$this->faculty_id = $row['faculty_id'];
		}

		public function getDesignation() {
			if ($this->is_faculty) {
				return "Faculty";
			} else if ($this->is_CR) {
				return "CR";
			} else if ($this->is_HOD) {
				return "HOD";
			} else {
				return "Student";
			}
		}

		public function getFacId() {
			return $this->faculty_id;
		}

		public function getName() {
			return $this->firstName . " " . $this->lastName;
		}
		public function firstName() {
			return $this->firstName;
		}
		public function lastName() {
			return $this->lastName;
		}

		public function getUsername() {
			return $this->username;
		}

		public function getCreated() {
			return $this->created;
		}

		public function getPic() {
			return $this->pic;
		}

		public function getId() {
			return $this->id;
		}

		public function getDept() {
			return $this->dept;
		}

		public function getMail() {
			return $this->email;
		}

		public function getPhone() {
			return $this->phone;
		}

		private $mail;

		public function checkMail($mail) {
			if (isset($_SESSION['mail'])) {
				if ($_SESSION['mail'] == 1) {
					return 1;
				}
				return 0;
			}
		}

	}/*class ends*/


?>