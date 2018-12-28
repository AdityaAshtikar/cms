<!-- Sticky Navbar for all contents -->
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<a class="navbar-brand" href="index.php">Home</a>
  			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    			<span class="navbar-toggler-icon"></span>
  			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item active">
						<a class="nav-link" href="allPosts.php">Posts <span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="library.php">Library</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="myNotes.php">My Shared Notes</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Questions
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="allQ.php">See all Questions</a>
							<a class="dropdown-item" href="ask.php">Ask Something</a>
							<!-- <div class="dropdown-divider"></div>
							<a class="dropdown-item" href="#">Share your Opinion</a> -->
						</div>
					</li>
					<?php 
						$username = $_SESSION['username'];
						$uq = mysqli_query($con, "SELECT id FROM users WHERE username='$username' AND is_faculty=1");
						$uRow = mysqli_fetch_array($uq);
						$uId = $uRow['id'];
						if (mysqli_num_rows($uq) > 0) {
							$qq = mysqli_query($con, "SELECT id, q_id, f_id, appr FROM qfa WHERE dppr=1 AND f_id=$uId");
							$qCount = mysqli_num_rows($qq);
					?>
							<li class="nav-item">
								<a class="nav-link" href="approvalRequests.php">Approval Requests - <span style="color: darkred; font-weight: bolder"><?php echo $qCount; ?></span></a>
							</li>
					<?php
						}
					?>
				</ul>
				<!-- <form class="form-inline my-2 my-lg-0">
					<input class="form-control mr-sm-2" type="search" size="40" placeholder="Search" aria-label="Search">
					<button class="btn btn-outline-info my-2 my-sm-0" type="submit">Search</button>
				</form> -->
			</div>
		</nav>