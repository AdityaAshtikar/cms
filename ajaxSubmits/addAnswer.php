<?php 
	include("../includes/config.php");
	$atext = addslashes($_POST['atext']);
	$qId = $_POST['qId'];
	$uId = $_POST['uId'];
	$insert = mysqli_query($con, "INSERT INTO answers(atext, user_id, q_id) VALUES('$atext', $uId, $qId)");
	if ($insert) {
		$answers = mysqli_query($con, "SELECT id, firstName, lastName FROM users WHERE id='$uId'");
		$aRow = mysqli_fetch_array($answers);
		$name = $aRow['firstName'] . $aRow['lastName'];
		echo "<p class=". "newAnswer" . ">" . nl2br($atext) . "</p>" . "<span><em> - " . $name . "</em></span>";
	}
?>