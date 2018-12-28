<?php 
	include("../includes/config.php");
	$username = $_SESSION['username'];
	include("../classes/User.php");
	$user = new User($con, $username);
	include("../classes/Post.php");
	include("../classes/Category.php");
	if (isset($_POST['text'])) {
		$uId = strip_tags($_POST['userId']);
		$userId = $uId;
		$text = addslashes(strip_tags($_POST['text']));
		$cat = strip_tags($_POST['category']);
		$category = $cat;
		$pri = strip_tags($_POST['priority']);
		$priority = $pri;
		$access_to = strip_tags($_POST['access_to']);
		$created = date('Y-m-d h:i:s');
		$status = 1;
		$insertPost = mysqli_query($con, "INSERT INTO post VALUES ('', '$text', '$category', '$priority', '$access_to', '$userId', '$created', $status)");
		// sending entire div to prependTo() status div element
		$newPostResult = mysqli_query($con, "SELECT id FROM post ORDER BY id DESC");
		$row = mysqli_fetch_array($newPostResult);
		$postId = $row['id'];
		$post = new Post($con, $postId);
		$postUserObject = $post->getUserId();
		$cat = new Category($con, $category);
		$postCatName = $cat->getName();
		echo "<div id='postContent'>
				<div class='actualPost'>
					<a href=detailedPost.php?id=" . $postId . ">
						<p style='color: black; font-weight: 600;'>" .
							substr(str_replace("\n", '<br>', $text), 0, 40);
							if(strlen($text) >40) echo "....<small>Read more</small>";
							echo "</p>
					</a>
					<span>
						<a href=profile.php?id=" . $postUserObject->getId() . ">
							<img src=" . $postUserObject->getPic() . " height=50 width=50 class=userPostImg>
						</a>
					</span>
					<span class='createdBy'>Created by: " . $postUserObject->getName() ." , " . $created . 
					"</span>
					<span class='postCategory'>
						Category: " . $postCatName .
					"</span>
					<span class='postPriority' style='color: red;'>
						Priority: " . $post->getPriority() . 
					"</span>
				</div><!-- actualPost -->
				<div class='comments'>
					<hr>
					<div class='writeComments'>
						<h5>Comments: </h5>
						<hr style='border: 0.7px solid violet;'>
						<!-- Add a Comment inputs bar -->
						<div class='commentTextArea'>
							<a href=profile.php?id=" . $user->getId() . "><img src=" . $user->getPic() . " height=35 width=40 class='commentsUserPic'></a>
							<input type='textarea' name='comment' class='form-control' placeholder='Write a Comment....' rows='4' cols='2'>
						</div>
					</div><!-- writeComments -->
					<div class='showComments'>
						<!-- TODO: show comments from db and ajax -->
					</div>
				</div><!-- comments -->
			</div><!-- postContent -->";
	}
?>
<?php

// // ------------------------- if sending a json response to ajax success call -----------------------------------
// 		// $responseArray = array("text"=>$text, "postUser"=>$name, "category"=>$catName, "priority"=>$priority, "access"=>$access_to, "created"=>$created);
// 		// sending json encoded array to ajax response for div filling
// 		/*header('content-type: application/json');
// 		echo json_encode($responseArray);*/

?>