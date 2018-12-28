<?php
	include('includes/config.php');
	$id = $_GET['id'];
	$delete = mysqli_query($con, "DELETE FROM book WHERE id='$id'");
	if ($delete) {
		header("Location: library.php?deleted=true");
		die();
	} else {
		echo "Could not delete";
	}

?>