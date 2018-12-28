<?php
	if (isset($_GET['searchLibraryButton'])) {
		include('includes/config.php');
		$q = $_GET['search'];
		$title = "Search | " . $q;
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
			$res = mysqli_query($con, "SELECT id, name, topic, comment, created, user_id FROM book WHERE name LIKE '%$q%' OR created LIKE '%$q%' OR topic LIKE '%$q%' OR comment LIKE '%$q%' ORDER BY id DESC");
			if (mysqli_num_rows($res) <= 0) {
				echo "<h1>No data found.</h1>";
			} else {
				while($book = mysqli_fetch_array($res)) {
					$topic = $book['topic'];
					$name = $book['name'];
					$created = $book['created'];
					$comment = $book['comment'];
					$user_id = $book['user_id'];
						// getting user id
						$userQuery = mysqli_query($con, "SELECT username FROM users WHERE id='$user_id'");
						$user = mysqli_fetch_array($userQuery);
						$username = $user['username'];
					include('includes/logged/libraryBookCard.php');
				}
			}
		}
	?>
				</div><!-- allNotes -->
		</div><!-- library -->