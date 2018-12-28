<?php 

	class Category {
		private $con;
		private $name;
		private $isRandom;
		private $postId;
		
		public function __construct($con, $id) {
			$this->con = $con;
			$result = mysqli_query($this->con, "SELECT * FROM category WHERE id='$id' AND status=1");

			$row=mysqli_fetch_array($result);
			$this->name = $row['name'];
			$this->isRandom = $row['isRandom'];
			$this->postId = $row['postId'];
		}

		public function getName() {
			return $this->name;
		}

		public function getIsRandom() {
			return $this->isRandom;
		}

		public function getPostId() {
			return new Post($this->con, $this->postId);
		}

	}



?>