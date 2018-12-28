<?php 
	include('includes/config.php');
	if ($_SESSION['mail'] == 0) {
		header("Location: index.php");
	}
	include('classes/User.php');
	$id = $_GET['id'];
	$res = mysqli_query($con, "SELECT username FROM users WHERE id='$id'");
	$row = mysqli_fetch_array($res);
	$username = $row['username'];
	if ($_SESSION['username'] != $username) {
		header("Location: index.php");
		die();
	}
	$user = new User($con, $username);
	$title = $user->getName() . " | Update";
	$cssStyle = "assets/css/index.css";
	include('includes/header.php');
	// include('handlers/userUpdateHandler.php');
?>
<?php include('includes/logged/finalNav.php'); ?>
<script>
	$(document).ready(function() {
		$("#uname").on("change", function() {
			var uname = $("#uname").val();
			if (uname.indexOf(" ") >=0) {
				alert("Username cannot contain whitespaces");
				$(".userUpdateButton").attr("disabled", true);
				$("#uname").focus();
			} else {
				$(".userUpdateButton").attr("disabled", false);
			}
		});
	});
</script>
<div id="UpdateProfile">
	<h4>Update Details: </h4><br>
	<form method="post" action="userUpdate2.php" enctype="multipart/form-data">
		<input type="hidden" name="userId" value="<?php echo $user->getId(); ?>">
		<p>Change Profile Photo: </p>
		Current: <a target="_blank" href="<?php echo $user->getPic(); ?>"><img height=80 width=80 src="<?php echo $user->getPic(); ?>"></a>
		<?php 
			if (isset($errors)) {
				if (in_array("Only jpg, png or jpeg types supported", $errors)) {
					echo "Only jpg, png or jpeg types supported";
				}
				if (in_array("File Could not be uploaded", $errors)) {
					echo "Only jpg, png or jpeg types supported";
				}
			}
		?>
		<input type="file" name="profilePic"><br><br>
		<div class="form-group">
			<label for="fname">First Name:</label>
			<input type="text" name="fname" class="form-control" id="fname" value="<?php echo $user->firstName(); ?>">
		</div>
		<div class="form-group">
			<label for="lname">Last Name: </label>
			<input type="text" name="lname" class="form-control" id="lname" value="<?php echo $user->lastName(); ?>">
		</div>
		<div class="form-group">
			<?php if(isset($errors)) if(in_array("Username must be at least 2 characters", $errors)) echo "Username must be at least 2 characters<br>"; ?>
			<label for="uname">Username: </label>
			<input type="text" name="uname" class="form-control" id="uname" value="<?php echo $user->getUsername(); ?>">
		</div>
		<button type="submit" name="updateButton" class="btn btn-primary userUpdateButton">Update Profile</button><br><hr>
		<a href="userDelete.php?id=<?php echo $user->getId(); ?>&username=<?php echo $user->getUsername(); ?>" class="btn btn-danger">Delete Profile</a>
	</form>
</div><!-- UpdateProfile -->