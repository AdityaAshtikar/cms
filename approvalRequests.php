<?php 
	include('includes/config.php');
	include('classes/User.php');
	$username = $_SESSION['username'];
	$isVerified = $_SESSION['mail'];
	if ($isVerified != 1) {
		header("Location: index.php?mail=wrong");
	}
	$user = new User($con, $username);
	$title = "Approval Requests";
	$cssStyle = "assets/css/index.css";
	include('includes/header.php');
	include('includes/logged/finalNav.php');
?>
<script src="assets/scripts/readMore.js"></script>
<div class="blockedQuestion">
	<?php 
		if (isset($_GET['status'])) {
			if (strcmp($_GET['status'], "changed") == 0) {
			?>
				<div class="alert alert-info alert-dismissible" id="errorDiv" style="z-index: 0;">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong>Question Status Changed</strong>
				</div>
			<?php
			} else {
			?>
				<div class="alert alert-info alert-dismissible" id="errorDiv" style="z-index: 0;">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong>Question Status could not be changed, try again</strong>
				</div>
			<?php
			}
		}
	?>
	<table class="table table-hover table-dark">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Question</th>
				<th scope="col">Asked by</th>
				<th scope="col">Number of faculty Approved</th>
				<th scope="col">Targetted Faculty</th>
				<th scope="col">Created</th>
			</tr>
		</thead>
		<tbody>
		<?php 
			$questions = mysqli_query($con, "SELECT * FROM questions WHERE status=0 ORDER BY id DESC");
			while ($qRow = mysqli_fetch_array($questions)) {
				$qId = $qRow['id'];
				$qtext = $qRow['qtext'];
				$isUnknown = $qRow['isUnknown'];
				if ($isUnknown != 1) {
					$user_id = $qRow['user_id'];
					$uQuery = mysqli_query($con, "SELECT username, firstName, lastName FROM users WHERE id='$user_id'");
					$uRow = mysqli_fetch_array($uQuery);
					$qUsername = $uRow['username'];
					$fname = $uRow['firstName'];
					$lname = $uRow['lastName'];
					$asked_by = $fname . " " . $lname . "(" . $qUsername . ")";
				} else {
					$asked_by = "Anonymous";
				}
				$status = $qRow['status'];
				$fac_appr_count = $qRow['fac_appr_count'];
				$created = $qRow['created'];
				$target_fac_id = $qRow['target_fac_id'];
				if ($target_fac_id != 0) {
					$fQuery = mysqli_query($con, "SELECT username, firstName, lastName FROM users WHERE id='$target_fac_id'");
					$fRow = mysqli_fetch_array($fQuery);
					$fUsername = $fRow['username'];
					$fname = $fRow['firstName'];
					$lname = $fRow['lastName'];
					$targettedTo = $fname . " " . $lname . "(" . $fUsername . ")";
				} else {
					$targettedTo = "No faculty targetted";
				}
				if ($status == 1) {
					echo "<tr bgcolor='lightblue'>";
				} else {
					echo "<tr bgcolor='#0d2d60'>";
				}
			?>
					<th scope='row'><?php echo $qId; ?></th>
					<td>
						<?php
							$questionText = nl2br($qtext);
							if (strlen($questionText) > 40) {
							?>
								<a id='seeQuestion'><?php echo substr($questionText, 0, 40) . "...." ?></a>
								<div class="readMoreQuestion" style="display: none;"><?php echo nl2br($questionText); ?></div>
							<?php
							} else {
								echo $questionText;
							}
						?>
					</td>
					<td><?php echo $asked_by; ?></td>
					<td><?php echo $fac_appr_count; ?></td>
					<td><?php echo $targettedTo; ?></td>
					<td><?php
						$stringDate = strtotime($created);
						$mysqldate = date( 'd-M-y H:i', $stringDate);
						echo $mysqldate;
					?></td>
					<?php 
						$LoggedFacId = $user->getId();
						$qfaQuery = mysqli_query($con, "SELECT * FROM qfa WHERE f_id='$LoggedFacId' AND q_id='$qId'");
						$qfaRow = mysqli_fetch_array($qfaQuery);
						if ($qfaRow['appr'] == 1) {
					?>
							<td><a href="blockUnblock.php?id=<?php echo $qId; ?>&unblock=true" class="btn btn-danger keepPending">Keep Pending</a></td>
					<?php
						} else {
					?>
							<td><a href="blockUnblock.php?id=<?php echo $qId; ?>&block=true" class="btn btn-primary approve">Approve</a></td>
					<?php
						}
					?>
				</tr>
			<?php
			}/*while loop*/
		?>
		</tbody>
	</table>
</div><!-- blockedQuestion -->
<script>
	$("#seeQuestion").hover( function() {
		$(this).css("cursor", "pointer");
		$(this).attr("title", "read more");
	});
		$("#seeQuestion").on('click', function() {
			console.log($(this).html());
		});
</script>