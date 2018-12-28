<?php 
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		include('includes/config.php');
		$username = $_SESSION['username'];
		include('classes/User.php');
		$user = new User($con, $username);
		/* getting id of user who just approved or blocked a question */
		$fac_id = $user->getId();
		$query = mysqli_query($con, "SELECT fac_appr_count, status FROM questions WHERE id='$id'");
		$countRow = mysqli_fetch_array($query);
		$appr_count = $countRow['fac_appr_count'];
		$qStatus = $countRow['status'];
		// decrease fac_appr_count if faculty blocks a question
		if (isset($_GET['unblock'])) {
			if (strcmp($_GET['unblock'], "true")==0) {
				if ($appr_count == 0) {
					$appr_count = 0;
				} else {
					$appr_count--;
				}
				if ($appr_count <=1) {
					$qQuery = mysqli_query($con, "UPDATE questions SET status=0, fac_appr_count='$appr_count', appr_fac_id='$fac_id' WHERE id='$id'");
				} else {
					$qQuery = mysqli_query($con, "UPDATE questions SET status=1, fac_appr_count='$appr_count', appr_fac_id='$fac_id' WHERE id='$id'");
				}
				if ($qQuery) {
					$qfaQuery = mysqli_query($con, "SELECT appr, dppr FROM qfa WHERE q_id='$id' AND f_id='$fac_id'");
					$qfaRow = mysqli_fetch_array($qfaQuery);
					$appr = $qfaRow['appr'];
					if ($appr > 0) {
						$update = mysqli_query($con, "UPDATE qfa SET dppr=1, appr=0 WHERE q_id='$id' AND f_id='$fac_id'");
					} else {
						$update = mysqli_query($con, "UPDATE qfa SET dppr=1, appr=0 WHERE q_id='$id' AND f_id='$fac_id'");
					}
					header("Location: approvalRequests.php?status=changed");
					die();
				} else {
					header("Location: approvalRequests.php?status=unchanged");
					die();
				}
			}
		}
		// increase fac_appr_count if faculty approves a question
		else if (isset($_GET['block'])) {
			if (strcmp($_GET['block'], "true")==0) {
				$appr_count++;
				if ($appr_count <=1) {
					$qQuery = mysqli_query($con, "UPDATE questions SET status=0, fac_appr_count='$appr_count', appr_fac_id='$fac_id' WHERE id='$id'");
				} else {
					$qQuery = mysqli_query($con, "UPDATE questions SET status=1, fac_appr_count='$appr_count', appr_fac_id='$fac_id' WHERE id='$id'");
				}
				if ($qQuery) {
					$qfaQuery = mysqli_query($con, "SELECT appr, dppr FROM qfa WHERE q_id='$id' AND f_id='$fac_id'");
					$qfaRow = mysqli_fetch_array($qfaQuery);
					$dppr = $qfaRow['dppr'];
					if ($dppr > 0) {
						$update = mysqli_query($con, "UPDATE qfa SET dppr=0, appr=1 WHERE q_id='$id' AND f_id='$fac_id'");
					} else {
						$update = mysqli_query($con, "UPDATE qfa SET dppr=0, appr=1 WHERE q_id='$id' AND f_id='$fac_id'");
					}
					header("Location: approvalRequests.php?status=changed");
					die();
				} else {
					header("Location: approvalRequests.php?status=unchanged");
					die();
				}
			}
		}
	}
?>