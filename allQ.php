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
	$title = "All Questions";
	$cssStyle = "assets/css/index.css";
	include("includes/header.php");
	include("includes/logged/finalNav.php");
	echo "<br><br><br><br><br><br><br><br>";
	$questionQuery = "SELECT * FROM questions JOIN users ON questions.user_id = users.id ORDER BY questions.id DESC";
	include("includes/logged/qna.php");
?>
<style type="text/css">
	#qna {
		margin: 0 auto;
		float: none;
	}
</style>
<script>
	$(document).ready(function() {
		$("#qna").animate({
			width: '+=30%'
		}, 1000);
	});
</script>