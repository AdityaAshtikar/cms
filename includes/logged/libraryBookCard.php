<div class="card">
	<div class="card-body">
		<h4 class="card-title">Topic: <a class="topic" href="book.php?name=<?php echo $book['topic']; ?>"><?php echo $book['topic']; ?></a>
			<?php 
				if ($user['username'] == $_SESSION['username']) {
			?>
					<a class="noteDelete" href="noteDelete.php?id=<?php echo $book['id']; ?>">Delete</a>
			<?php
				}
			?>
		</h4>
		<p class="card-text comment">Subject: <em><b><?php echo $book['comment']; ?></b></em></p>
		<?php 
			$topicDir = $book['topic'];
			if (stripos($topicDir, " ")) {
				$topicDir = str_replace(" ", "_", $topicDir);
			}
			$extension = pathinfo($book['name'], PATHINFO_EXTENSION);
			if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png') {
				echo "<a target='_blank' href=assets/notes/" . $topicDir . "/" . $book['name'] . ">" . $book['name'] . "</a><hr>";
				echo "<a download target='_blank' href=assets/notes/" . $topicDir . "/" . $book['name'] . ">" . "download" . "<img src=" . "assets/images/icons/download.png" . ">" . "</a>";
			} else {
				echo "<a target='_blank' href=assets/notes/" . $topicDir . "/" . $book['name'] . ">" . $book['name'] . "</a><hr>";
				echo "<a download target='_blank' href=assets/notes/" . $topicDir . "/" . $book['name'] . ">" . "download" . "<img src=" . "assets/images/icons/download.png" . ">" . "</a>";
			}
		?>
		<hr>
		<p class="card-text">Submitted on: 
			<?php 
				echo "<em>" . $user['username'] . "</em>";
			?> - <?php echo $book['created']; ?>
		</p>
	</div><!-- card-body -->
</div><!-- card -->