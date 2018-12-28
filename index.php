<?php 
	include("includes/config.php");
	$username = $_SESSION['username'];
	$mail = $_SESSION['mail'];
	include("classes/User.php");
	include("classes/Post.php");	/* post class uses user */
	include("classes/Category.php");	/* Category class uses post */
		$user = new User($con, $username);
	if (!isset($_SESSION['username'])) {
		header("Location: register.php?login=inv");
		die();
	}
	if (isset($_GET['mail'])) {
		if (strcmp($_GET['mail'], "wrong")) {
		?>
			<div class="alert alert-warning alert-dismissible fade show" role="alert">
				<strong>Verify your mail to see pending questions approval</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
		<?php
		}
	}
	$title = "Fakebook";
	$cssStyle = "assets/css/index.css";
	include("includes/header.php");
?>
<script src="assets/scripts/addPost.js"></script>
<div id="fixedNav">
	<!-- userInfo nav div -->
	<?php include("includes/logged/navdiv.php"); ?>
	<!-- Sticky Navbar for all contents -->
	<?php include("includes/logged/navbar.php"); ?>
</div>
<br>
<?php
	if ($mail == 0) {
		include('includes/logged/noMailIndex.php');
	} else if($mail == 1) {
		include('includes/logged/mailIndexWritePost.php');
	}
?>
<hr>
<?php $questionQuery = "SELECT * FROM questions JOIN users ON questions.user_id = users.id ORDER BY questions.id DESC LIMIT 5"; include('includes/logged/qna.php'); ?>
<?php include("includes/logged/postsStatus.php"); ?>