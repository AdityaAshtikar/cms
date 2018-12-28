<?php 
	if (isset($_POST['askButton'])) {
		include('includes/config.php');
		$username = $_SESSION['username'];
		$text = rtrim(strip_tags(addslashes($_POST['text'])));
		$isUnknown = rtrim(strip_tags(addslashes($_POST['isUnknown'])));
		if ($isUnknown == 1) {
			$isUnknown = 1;
		} else {
			$isUnknown = 0;
		}
		if (isset($_POST['targetFaculty'])) {
			$targetFaculty = rtrim(strip_tags(addslashes($_POST['targetFaculty'])));
		}
		$getUserID = mysqli_query($con, "SELECT id, is_faculty, is_HOD FROM users WHERE username='$username'");
		$uRow = mysqli_fetch_array($getUserID);
		$user_id = $uRow['id'];
		$is_fac = $uRow['is_faculty'];
		$is_HOD = $uRow['is_HOD'];
		$created = date("Y-m-d h:i:s");
		if ($is_fac == 1) {
			$status = 1;
			$insert = mysqli_query($con, "INSERT INTO questions(qtext, user_id, isUnknown, target_fac_id, created, status) VALUES('$text', $user_id, $isUnknown, $targetFaculty, '$created', $status)");
		} else {
			$insert = mysqli_query($con, "INSERT INTO questions(qtext, user_id, isUnknown, target_fac_id, created) VALUES('$text', $user_id, $isUnknown, $targetFaculty, '$created')");
			$qId = mysqli_insert_id($con);
			$insertInQfa = mysqli_query($con, "INSERT INTO qfa (q_id, f_id, appr, dppr) VALUES($qId, $user_id, 0, 1)");
		}
		if ($insert) {
			header("Location: index.php");
		} else {
			echo "Could not insert";
		}
	}
?>