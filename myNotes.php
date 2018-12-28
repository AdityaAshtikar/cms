<?php
	include('includes/config.php');
	$username = $_SESSION['username'];
	$title = $username . '\'s notes';
	$cssStyle = "assets/css/index.css";
	include('includes/header.php');
	include("includes/logged/navbar.php");
?>

	<script src="assets/scripts/addBook.js"></script>
	<div class='library'>
		<?php include("includes/logged/librarySearchAndModal.php"); ?>
		<hr>
		<div class="allNotes">
		<h4 style="text-align: center;">&nbsp;&nbsp;
			<a class="btn btn-primary" href="library.php">All Notes</a>
		</h4>
<?php
		$userQuery = mysqli_query($con, "SELECT id, username FROM users WHERE username='$username'");
		$user = mysqli_fetch_array($userQuery);
		$userId = $user['id'];
		$res = mysqli_query($con, "SELECT id, name, topic, comment, created FROM book WHERE user_id='$userId' ORDER BY id DESC");
		if (mysqli_num_rows($res) <= 0) {
			echo "<h1>You have not added any notes.</h1>";
		} else {
			while($book = mysqli_fetch_array($res)) {
				$topic = $book['topic'];
				$name = $book['name'];
				$created = $book['created'];
				$comment = $book['comment'];
				include('includes/logged/libraryBookCard.php');
			}
		}
?>
		</div><!-- allNotes -->
	</div><!-- library -->