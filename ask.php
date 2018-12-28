<?php 
	include('includes/config.php');
	$username = $_SESSION['username'];
	$title = "Ask a new Question ";
	$cssStyle = "assets/css/index.css";
	include('includes/header.php');
	include('classes/User.php');
	include('includes/logged/finalNav.php');
	if (!checkSession('username')) {
		header("Location: index.php");
	}
?>
<div class="ask container">
	<h1>Ask a new question: </h1>
	<form class="form-block" method="post" action="newq.php">
		<div class="form-group">
			<label for="question"></label>
			<textarea class="form-control" id="question" rows="3" placeholder="Ask Anything..." cols="50" name="text" required></textarea>
		</div>
		<div class="form-group">
			<label for="isUnknown">Want to post as anonymous?</label>
			<small>* By selecting this, no one will know you asked this question</small>
			<input type="checkbox" id="isUnknown" name="isUnknown" value="1">
		</div>
		<div class="form-group">
			<label for="targetFaculty">Select the faculty this question is targetted to: </label>
			<small>* Do not select if no one specific is targetted</small>
			<select class="form-control" id="targetFaculty" name="targetFaculty">
				<option value="0"></option>
				<?php 
					$fac = mysqli_query($con, "SELECT id, firstName, lastName FROM users WHERE is_faculty=1 OR is_HOD=1");
					while($fRow = mysqli_fetch_array($fac)){
						echo "<option value=" . $fRow['id'] . ">" . $fRow['firstName'] . " " . $fRow['lastName'] . "</option>";
					}
				?>
			</select>
		</div>
		<button name="askButton" class="form-control btn btn-info">Submit question</button>
		<br><br>
	</form>
</div><!-- ask -->