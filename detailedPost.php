<?php 
	include("includes/config.php");
	$username = $_SESSION['username'];
	$mail = $_SESSION['mail'];
	include("classes/User.php");
	include("classes/Post.php");	/* post class uses user */
	include("classes/Category.php");	/* Category class uses post */
		$user = new User($con, $username);
	if (!isset($_SESSION['username'])) {
		header("Location: register.php?login=inv");
		die();
	}
	if (isset($_GET['mail'])) {
		if (strcmp($_GET['mail'], "wrong")) {
		?>
			<div class="alert alert-warning alert-dismissible fade show" role="alert">
				<strong>Verify your mail to see pending questions approval</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
		<?php
		}
	}
	if (!isset($_GET['id'])) {
		header("Location: index.php");
		die();
	}
	$id = $_GET['id'];
	$title = "Post";
	$cssStyle = "assets/css/index.css";
	include("includes/header.php");
	include("includes/logged/finalNav.php");
?>
<br><br><br><br><br><br><br><br>
<script>
	$(document).ready(function() {
		$("#showPosts").animate({
			width: '+=30%'
		}, 1000);
	});
</script>
<script src="assets/scripts/addComment.js"></script>
<style type="text/css">
	#showPosts {
		margin: 0 auto;
	}
	.postDelete {
		font-size: 20px;
		margin: 0px;
		border: 1px solid black;
		float: right;
	}
</style>
<div id="showPosts" class="container">
	<h3><a href="allPosts.php">Recent Posts:</a></h3>
		<?php 
			$postResult = mysqli_query($con, "SELECT * FROM post WHERE status=1 AND id='$id'");
			if ($row=mysqli_fetch_array($postResult)) {
				$postId = $row['id'];
				$content = $row['content'];
				$cat_id = $row['cat_id'];
				$isImportant = $row['isImportant'];
				$access_to = $row['access_to'];
				$user_id = $row['user_id'];
				$created = $row['created'];
		?>
				<div id="postContent">
					<?php 
							$post = new Post($con, $postId);
							$postUserObject = $post->getUserId();
					?>
					<div class="actualPost">
						<a href=detailedPost.php?id=<?php echo $postId; ?>>
							<p style="color: black; font-weight: bolder;"><?php echo nl2br($row['content']); ?>
						</a>
						<?php if($user_id == $user->getId())
							echo "<br><a href=postDelete.php?id=" . $postId . " class='postDelete'>" . "Delete" . "</a>";
						?>
						<span>
							<a href=profile.php?id=<?php echo $postUserObject->getId(); ?> >
								<img src=<?php echo $postUserObject->getPic(); ?> height=40 width=40 class=userPostImg>
							</a>
						</span>
						<span class="createdBy">Created by: 
							<?php 
								echo $postUserObject->getName();
							?>, <?php echo $created; ?>
						</span>
						<span class="postCategory">
							Category: 
							<?php 
								$cat = new Category($con, $cat_id);
								$postCatName = $cat->getName();
								echo $postCatName;
							?>
						</span>
						<span class="postPriority" style="color: red;">
							Priority: 
							<?php echo $post->getPriority(); ?>
						</span>
					</div><!-- actualPost -->
					<div class="comments">
						<hr>
						<div class="writeComments">
							<h5>Comments: </h5>
							<hr style="border: 0.7px solid violet;">
							<!-- Add a Comment inputs bar -->
							<div class="commentTextArea">
								<a href=profile.php?id=<?php echo $user->getId(); ?> ><img src=<?php echo $user->getPic(); ?> height=35 width=40 class="commentsUserPic"></a>
								<input type="textarea" name="comment" id="commentArea" class="form-control" placeholder="Write a Comment...." rows="4" cols="2">
								<input type="hidden" name="postId" id="postId" value="<?php echo $postId; ?>">
								<button id="commentSubmit">Comment</button>
							</div>
						</div><!-- writeComments -->
						<hr>
						<div class="showComments">
							<!-- TODO: show comments from db and ajax -->
							<?php 
								$comments = mysqli_query($con, "SELECT * FROM comments WHERE postId='$postId' ORDER BY id DESC LIMIT 2");
								while($cRow = mysqli_fetch_array($comments)) {
									$userId = $cRow['user_id'];
									$getCommentUser = mysqli_query($con, "SELECT profile_pic FROM users WHERE id='$userId'");
									$ucRow = mysqli_fetch_array($getCommentUser);
									$userPic = $ucRow['profile_pic'];
									echo "<div class=" . "commentText>" . nl2br($cRow['comment']) . "</div>";
									echo "<div class=" . "userPic>" . "<img src=" . $userPic . " height=50 width=50>" . "</div>";
									echo "<div class=" . "commentCreated>" . $created . "</div>";
									echo "<div class=" . "commentUserName>By: " . $username . "</div>";
									echo "<hr>";
								}
								$cQuery = mysqli_query($con, "SELECT id FROM comments WHERE postId='$postId'");
								if (mysqli_num_rows($cQuery) >2) 
									echo "<a href=detailedPost.php?id=". $postId .">Show more comments</a>";
							?>
						</div>
					</div><!-- comments -->
				</div><!-- postContent -->
			<?php } ?>
</div>