<?php 
	include('includes/config.php');
	if (isset($_POST['updateButton'])) {
		$id = trim(strip_tags(addslashes($_POST['userId'])));
		$fname = trim(strip_tags(addslashes($_POST['fname'])));
		$lname = trim(strip_tags(addslashes($_POST['lname'])));
		$uname = trim(strip_tags(addslashes($_POST['uname'])));
		// insert into db only if file is uploaded
		if(isset($_FILES['profilePic']) && $_FILES['profilePic']['error'] != UPLOAD_ERR_NO_FILE) {
			$target_dir = "assets/images/profilePic/";
			$target_file = $target_dir . basename($_FILES['profilePic']['name']);
			$uploadOK = 1;
			$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
			if ($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg') {
				$uploadOK = 0;
			}
			if ($uploadOK == 0) {
				echo "Wrong File Format, Try Again";
			} else {
				if(move_uploaded_file($_FILES['profilePic']['tmp_name'], $target_file)) {
					$update = mysqli_query($con, "UPDATE users SET firstName='$fname', lastName='$lname', username='$uname', profile_pic='$target_file' WHERE id='$id'");
				} if ($update) {
					header("Location: profile.php?id=$id");
				} else {
					echo "Could not update";
				}
			}
		} else {
				$update = mysqli_query($con, "UPDATE users SET firstName='$fname', lastName='$lname', username='$uname' WHERE id='$id'");
				$_SESSION['username'] = $uname;
				if ($update) {
					header("Location: profile.php?id=$id");
				} else {
					echo "Could not update";
				}
		}
	}
?>