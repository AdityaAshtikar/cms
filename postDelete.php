<?php 
	include("includes/config.php");
	if (!isset($_GET['id'])) header("Location: allPosts.php");
	$id = $_GET['id'];
	$delete = mysqli_query($con, "DELETE FROM post WHERE id='$id'");
	if($delete) {
		header("Location: allPosts.php");
	} else echo "Could not delete";
?>