<?php 
	include('includes/config.php');
	include('classes/User.php');
	include('classes/Category.php');
	$id = $_GET['id'];
	$res = mysqli_query($con, "SELECT username FROM users WHERE id='$id'");
	$row= mysqli_fetch_array($res);
	$username = $row['username'];
	$user = new User($con, $username);
	$name = $user->getName();
	$title = $name . " (" . $username . ")";
	$cssStyle = "assets/css/index.css";
	include('includes/header.php');
?>
<?php include('includes/logged/finalNav.php'); ?>
<style type="text/css">
	#UserProfileInformation {
		margin: 0 auto;
		border: none;
	}
</style>
<div id="UserProfileThings">
	<div id="UserProfileInformation">
		<div class="userProfileImage">
			<img src="<?php echo $user->getPic(); ?>" height=50 width=50>
		</div>
		<h5>Name: <em><?php echo $user->getName(); ?></em></h5>
		<h5>Username: <em><?php echo $user->getUsername(); ?></em></h5>
		<h5>Department: <em><?php echo $user->getDept(); ?></em></h5>
		<h5>Email: <em><?php echo $user->getMail(); ?></em></h5>
		<h5>Phone: <em><?php echo $user->getPhone(); ?></em></h5>
		<?php if ($user->is_faculty || $user->is_HOD) {
			echo "<h5>Faculty ID: <em>" . $user->getFacId() . "</em></h5>";
		} ?>
		<h5>Joined: <em><?php echo $user->getCreated(); ?></em></h5>
		<?php 
			if ($_SESSION['username'] == $username) {
				if ($_SESSION['mail']==1) {
					echo "<a class='btn btn-info' href='userUpdate.php?id=" . $user->getId() . "'>Update</a>";
				}
			}
		?>
	</div><!-- UserProfileInformation -->
	<!-- TODO: User's saved notes or documents -->
	<hr>
</div><!-- UserProfileThings -->
<div id="UserProfilePosts">
		<?php 
			$posts = mysqli_query($con, "SELECT * FROM post WHERE user_id ='$id' ORDER BY id DESC");
			if (mysqli_num_rows($posts) <= 0) {
				echo "<h3>You have not added any post yet</h3><hr>";
			}
		?>
			<h4 style="color: black;">Your Posts: <small><?php echo mysqli_num_rows($posts); ?></small></h4><hr>
		<?php
			while ($posts_row = mysqli_fetch_array($posts)) {
		?>
				<div class="postByUser" style="border: 1px solid blue;">
					<h5><?php echo substr(str_replace("\n", "<br>", $posts_row['content']), 0, 60); if(strlen($posts_row['content']) >60) echo "....<small>Read more</small>"; ?></h5>
					<hr>
					Priority: <em><?php if($posts_row['isImportant']) echo "Important"; else echo "Not Important"; ?></em><br>
					Category:
					<?php 
						$cat_id = $posts_row['cat_id'];
						$cat = new Category($con, $cat_id);
						echo $cat->getName();
					?><br>
					Accessible To: <em><?php echo $posts_row['access_to'] ?></em><br>
					Created: <em><?php echo $posts_row['created']; ?></em>
				</div>
				<hr>
		<?php 
			}
		?>
</div><!-- UserProfilePosts -->