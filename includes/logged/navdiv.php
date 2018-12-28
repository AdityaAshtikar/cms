<!-- userInfo nav div -->
<div id="nav">
	<div id="userInfo">
		<?php 
			$navUser = new User($con, $_SESSION['username']);
		?>
		<h4><?php echo $navUser->getDesignation() . ": " . $navUser->getName(); ?></h4>

		<!-- Taking Profile Pic from db -->
		<a href="profile.php?id=<?php echo $navUser->getId(); ?>"><img height="50" width="50" title="<?php echo $navUser->getUsername() . " Profile Pic"; ?>" alt="<?php echo $navUser->getUsername() . " Profile Pic"; ?>" src="<?php echo $navUser->getPic(); ?>"></a>
		<span><a href="logout.php">Logout</a></span>
		<img src="assets/images/icons/bread.png" class="more_icon" title="More Options">
	</div><!-- userInfo -->
</div><!-- nav -->