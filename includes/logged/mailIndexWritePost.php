<!-- Writing posts with access controlled submission -->
		<form name="postForm" id="postForm" method="post">
			<div id="writePost">

				<!-- where post is typed -->
				<div class="postContainer">
					<div class="form-group">
						<input id="userId" type="hidden" name="userId" value="<?php echo $user->getId(); ?>">
						<textarea name="text" id="post" class="form-control" placeholder="Share something...." rows="4" cols="2" required></textarea>
					</div>
				</div><!-- postContainer -->

				<!-- Category of the post, default: Random or dropdown of faculty defined categories -->
				<div class="addCategory">
					<div class="selectTagTitle"><span class="selectTitle">Category: </span><br>
						<select name="category" id="category" class="custom-select-mdm-select custom-select-md mb-3 category" required>
						  <optgroup label="Faculty defined: "></optgroup>
						  <!-- getting categories from db -->
						  <?php 
						  	$categories = mysqli_query($con, "SELECT id, name FROM category WHERE status=1");
						  	while($cat_row = mysqli_fetch_array($categories)) {
						  		$catName = $cat_row['name'];
						  		$catId = $cat_row['id'];
						  ?>
						  		<option value="<?php echo $catId; ?>"><?php echo $catName; ?></option>
						  <?php
						  	}
						  ?>
						</select>
					</div><!-- selectTagTitle -->
					<!-- dropdown for who can see, and priority-> default: random or important -->
					<div class="selectTagTitle"><span class="selectTitle">Priority: </span><br>
						<select name="priority" id="priority" class="custom-select custom-select-md mb-3 category accessControl" required>
						 	<option value="1">Important</option>
						 	<option value="0">Not Important</option>
						</select>
					</div><!-- selectTagTitle -->

					<div class="selectTagTitle"><span class="selectTitle">Access To: </span><br>
						<select name="access_to" id="access_to" class="custom-select custom-select-md mb-3 category accessible" required>
						 	<option value="everyone">Everyone</option>
						 	<option value="student">only students</option>
						 	<option value="faculty">only faculties</option>
						 	<option value="hod">only HODs</option>
						</select>
					</div><!-- selectTagTitle -->
				</div><!-- addCategory -->
				<div class="submitPost">
					<button type="submit" id="addPostSubmit" class="btn addPostButton" name="postSubmit">Share</button>
				</div><!-- submitPost -->
			</div><!-- writePost -->
		</form>