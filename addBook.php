<?php 
	include('includes/config.php');
	if (isset($_POST['addBookButton'])) {
		
		$username = $_POST['username'];
		$idQuery = mysqli_query($con, "SELECT id FROM users WHERE username='$username'");
			$idRow = mysqli_fetch_array($idQuery);
			$user_id = $idRow['id'];

		$topic = $_POST['topic'];
		$topicDir = str_replace(" ", "_", $topic);
		$comment = $_POST['comment'];

		$created = date('Y-m-d h:i:s');

		$total = count($_FILES['notes']['name']);
		// looping through each file
		for ($i=0; $i < $total; $i++) { 
			$name = $_FILES['notes']['name'][$i];
			// Create directory if it does not exists
			if (!is_dir("assets/notes/" . $topicDir . "/")) {
				mkdir("assets/notes/" . $topicDir . "/");
			}
			// save file using "topic" + index
			$targetPath =  "assets/notes/" . $topicDir . "/" . $_FILES['notes']['name'][$i];
			if(move_uploaded_file($_FILES['notes']['tmp_name'][$i], $targetPath)) {
				$insert = mysqli_query($con, "INSERT INTO book(name, user_id, created, topic, comment) VALUES('$name', $user_id, '$created', '$topic', '$comment')");
				if ($insert) {
					header("Location: library.php");
				} else {
					echo "Could not insert";
				}
			} else {
				echo "Could not upload or insert<br>";
			}
		}
	}
?>