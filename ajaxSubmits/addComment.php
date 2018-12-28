<?php 
	include("../includes/config.php");
	$username = $_SESSION['username'];
	include("../classes/User.php");
	$user = new User($con, $username);
	$userId = $user->getId();
	$userPic = $user->getPic();
	if (isset($_POST['comment'])) {
		$comment = addslashes($_POST['comment']);
		$postId = $_POST['postId'];
		$created = date("Y:m:d h:i:s");
		$query = mysqli_query($con, "INSERT INTO comments (postId, user_id, comment, created) VALUES($postId, $userId, '$comment', '$created')");
		if($query) {
			echo "<div class=" . "commentText>" . nl2br($comment) . "</div>";
			echo "<div class=" . "userPic>" . "<img src=" . $userPic . " height=50 width=50>" . "</div>";
			echo "<div class=" . "commentCreated>" . $created . "</div>";
			echo "<div class=" . "commentUserName>By: " . $username . "</div>";
			echo "<hr>";
		} else {
			echo "Could not submit comment";
		}
	} else {
		header("Location: allPosts.php");
	}
?>