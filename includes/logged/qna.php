<script src="../../cms/assets/scripts/newAnswer.js"></script>
<script src="../../cms/assets/scripts/readMore.js"></script>
<div id="qna">
	<h3><a href="allQ.php">Recent Questions: </a></h3>
	<?php 
		// include("includes/config.php");
		$loggedUsername = $_SESSION['username'];
		$questions = mysqli_query($con, $questionQuery);
		while ($qRow = mysqli_fetch_array($questions)) {
			$user_id = $qRow['user_id'];
			$tableUsername = $qRow['username'];
			if (!$qRow['isUnknown'])
				$qUsername = $qRow['username'];
			else $qUsername = "anonymous";
			$isHOD = $qRow['is_HOD'];
			$isFaculty = $qRow['is_faculty'];
			$targetted = $qRow['target_fac_id'];
			$tResult = mysqli_query($con, "SELECT firstName, lastName FROM users WHERE id='$targetted'");
			$tRow = mysqli_fetch_array($tResult);
			$targetFac = $tRow['firstName']. " " .$tRow['lastName'];
?>
			<?php 
				if ($qRow['status']!=1 && $loggedUsername != $tableUsername) {
					echo "<div class='question unDisplayed'" /* "style='visibility: hidden; height: 0px;'" */ . ">";
					// echo nl2br($qRow['qtext']);
				} else {
					echo "<div class='question'>";
				}
			?>
				<div class="status">
					<?php 
						if($qRow['status'] == 0) {
							echo "<small style='color: red;'>{Yet to be approved by faculties}</small>";
							echo "<hr>";
						}
					?>
				</div>
				<!-- display all questions by faculty -->
				<?php
					// if ($isFaculty==1) {
						echo substr(str_replace("\n", "<br>", $qRow['qtext']), 0, 50);
						if (strlen($qRow['qtext']) >50)
							echo "<br><small><a id=seeQuestion>Read More....</a></small>";
							echo "<div style='display: none;' class=" . "readMoreQuestion" . " style=" . "display: none;" . ">" . nl2br($qRow['qtext']) . "</div>";
					// }
					// <!-- display questions by students only if two or more faculties approve them -->
					// else if ($qRow['status']!=1) {
						// checking session stored username for qUsername
						// if ($loggedUsername == $tableUsername) {
							// echo nl2br($qRow['qtext']);
						// } else {
							// echo "<span style='visibility: hidden'>" . nl2br($qRow['qtext']) . "</span>";
						// }
					// }
				?>

				<!-- <div class="vote"> -->
					<!-- <small class="upvote"><button id="upvote" title="concur"><img src="assets/images/icons/upvote.png"></button> --><!-- {Upvote Number}<?php /*echo $qRow['upvote'];*/ ?></small> -->
					<!-- <small class="downvote"><button id="downvote" title="redundant"><img src="assets/images/icons/downvote.png"></button> --><!-- {Downvote Number}<?php/* echo $qRow['downvote'];*/ ?></small> -->
					<!-- <small> --><!-- {number} --><!-- <?php /*echo $qRow['upvote_fac_count'];*/ ?> faculty Upvoted this</small> -->
				<!-- </div> --><!-- vote -->
				<small class="askedBy">Created: <span><!-- {asked date and time} -->
					<?php 
						$created = $qRow['created'];
						$stringDate = strtotime($created);
						$mysqldate = date('d-M-y H:i', $stringDate);
						echo $mysqldate;
					?>
					</span></small>
				<small class="askedBy">asked by: <span><!-- {username or anonymous} --><?php echo $qUsername; ?></span></small>
				<?php if(!empty($qRow['target_fac_id']))
					echo "<small class='askedBy'>Targetted to: <span>" . $targetFac . "</span></small>";
				?>
				<div class="answer">
					<textarea rows="2" cols="2" name="answer" id="answer" placeholder="Give your opinion"></textarea>
					<br>
					<input type="hidden" id="qId" name="q_id" value="<?php echo $qRow['id']; ?>">
					<input type="hidden" id="uId" name="u_id" value="<?php echo $user->getId(); ?>">
					<button id="answerSubmit">Answer</button>
					<hr>
					<p class="newAnswer">
						<?php 
							$currQId = $qRow['id'];
							$answers = mysqli_query($con, "SELECT * FROM answers WHERE q_id='$currQId' ORDER BY id DESC LIMIT 1");
							$aRow = mysqli_fetch_array($answers);
							$quID = $aRow['user_id'];
							$quQuery = mysqli_query($con, "SELECT firstName, lastName FROM users WHERE id='$quID'");
							$quRow = mysqli_fetch_array($quQuery);
							$name = $quRow['firstName'] . $quRow['lastName'];
						?>
						<?php echo nl2br($aRow['atext']); ?>
						<span><em><?php echo " - " . $name; ?></em></span>
					</p>
				</div><!-- answer -->
			</div><!-- question -->	
<?php
	}
?>
<?php 
	$qRes = mysqli_query($con, "SELECT id FROM questions");
	if (mysqli_num_rows($qRes) >5)
?>
		<br><h5><a href="allQ.php">See all Questions >></a></h5>
</div><!-- qna -->