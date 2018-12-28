<?php 

	class Post {

		private $con;
		private $result;
		private $id;
		private $content;
		private $cat_id;
		private $isImportant;
		private $access_to;
		private $user_id;
		private $created;

		public function __construct($con, $id) {
			$this->con = $con;
			$this->id = $id;
			$this->result = mysqli_query($this->con, "SELECT * FROM post WHERE id='$id' AND status=1 ORDER BY created DESC");

			while ($row=mysqli_fetch_array($this->result)) {
				$this->id = $row['id'];
				$this->content = $row['content'];
				$this->cat_id = $row['cat_id'];
				$this->isImportant = $row['isImportant'];
				$this->access_to = $row['access_to'];
				$this->user_id = $row['user_id'];
				$this->created = $row['created'];
			}
		}

		public function getId() {
			return $this->id;
		}
		
		public function getContent() {

			return $this->content;
		}

		public function getCatId() {
			return $this->cat_id;
		}
		
		public function getPriority() {
			if ($this->isImportant == 1) {
				return "Important";
			}
			return "not Important";
		}
		
		public function getAccessTo() {
			return $this->access_to;
		}
		
		public function getUserId() {
			$userId = mysqli_query($this->con, "SELECT username FROM users WHERE id='$this->user_id'");
			$user_row = mysqli_fetch_array($userId);
			$username = $user_row['username'];
			return new User($this->con, $username);
		}
		
		public function getCreated() {
			return $this->created;
		}

	}


?>