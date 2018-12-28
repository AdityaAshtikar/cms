<?php 
	include('includes/config.php');
	$title = "Library";
	$cssStyle = "assets/css/index.css";
	include('includes/header.php');
	include('includes/logged/navbar.php');
	if (isset($_GET['deleted'])) {
		if ($_GET['deleted'] == "true") {
?>
			<div class="alert alert-info alert-dismissible" id="errorDiv">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>File Deleted</strong>
			</div>
<?php
		}
	}
?>
<script src="assets/scripts/addBook.js"></script>
<div class="library">
	<?php include("includes/logged/librarySearchAndModal.php"); ?>
	<hr>
	<h1 class="container-fluid">&nbsp;&nbsp;All Notes: </h1>
	<div class="allNotes">
		<?php 
			$books = mysqli_query($con, "SELECT id, name, user_id, created, topic, comment FROM book ORDER BY id DESC, created DESC");
			if (mysqli_num_rows($books) <= 0) {
				echo "<h4>No Notes Available</h4><hr>";
			} else {
				while($book = mysqli_fetch_array($books)) {
					$user_id = $book['user_id'];
					$users = mysqli_query($con, "SELECT username FROM users WHERE id = '$user_id'");
					$user = mysqli_fetch_array($users);
					include('includes/logged/libraryBookCard.php');
				}
			}
		?>
	</div><!-- allNotes -->
</div><!-- library -->