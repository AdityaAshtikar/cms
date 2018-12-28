<div class="searchLibrary">
		<form method="get" action="searchLibrary.php">
			<input type="text" name="search" class="searchInput" placeholder="Search by topics, subjects, date">
			<button style="border: none; background: none;" type="submit" class="searchLibraryButton" name="searchLibraryButton"><img class="searchImage" src="assets/images/icons/search.png"></button>
		</form>
	</div><!-- searchLibrary -->
	<br>
	<?php if ($_SESSION['mail'] == 1) {
	?>
		<div class="modalToggleButton">
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
				Contribute to this library
			</button>
		</div>
	<?php 
	} else {
		echo "<h4 style='text-align: center;'>Confirm email to add notes</h4>";
	} ?>
	<div class="modal fade" id="myModal">
		<div class="modal-dialog" style="max-width: 50%;">
			<div class="modal-content">
			<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title">Add books or notes</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div><!-- modal-header -->
				<!-- Modal body -->
				<div class="modal-body">
					<div class="addBook">
						<form name="addBook" method="post" action="addbook.php" enctype="multipart/form-data">
							<input type="hidden" name="username" value="<?php echo $_SESSION['username']; ?>">
							Notes: <input type="file" name="notes[]" class="form-control" required multiple>
							<span class="form-text text-muted">ctrl+select to upload multiple files</span>
							<br>
							Topic: <input type="text" name="topic" required class="form-control" maxlength="100">
							<span class="form-text text-muted">Use less than 100 characters to describe your topic</span>
							<br>
							Subject: <input type="text" name="comment" required class="form-control">
							<br>
							<input id="addBookButton" type="submit" name="addBookButton" value="Add" class="form-control btn btn-info">
						</form>
					</div><!-- addbook -->
				</div><!-- modal-body -->
				<!-- Modal footer -->
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div><!-- modal-footer -->
			</div>
		</div>
	</div>