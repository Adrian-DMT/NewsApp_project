<?php

require_once "../components/header.php";

$newsId = $_GET['id'];
$comment = '';
// GET LOGED IN USER DATA FROM DB
$query = $pdo->prepare("SELECT id FROM users WHERE username = '$username'");
$query->execute();
$user = $query->fetch(PDO::FETCH_ASSOC);

// PUT comment INTO DB
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['comment'] !== '') {
	$comment = $_POST['comment'];
	$id_users = $user['id'];
	$id_news = $_GET['id'];

	$statement = $pdo->prepare("INSERT INTO comments (comment, id_users, id_news)VALUES(:comment, :id_users, :id_news)");
	$statement->bindValue(':comment', $comment);
	$statement->bindValue(':id_users', $id_users);
	$statement->bindValue(':id_news', $id_news);
	$statement->execute();
}

// GET COMMENTS and USERS FROM DB
$dataUsers = $pdo->prepare("SELECT * FROM users RIGHT JOIN comments ON users.id  = comments.id_users  ORDER BY comments.created_date DESC");
$dataUsers->execute();
$users = $dataUsers->fetchAll(PDO::FETCH_ASSOC);


$dataReplay = $pdo->prepare("SELECT users.username, users.profile_image, replays.id, replays.replay, replays.comment_id, replays.created_date FROM replays right JOIN users ON replays.id_user = users.id JOIN comments ON comments.id = replays.comment_id ORDER BY replays.created_date desc");
$dataReplay->execute();
$replays = $dataReplay->fetchAll(PDO::FETCH_ASSOC);

?>



<main class="container w-4/5 mx-auto grow">
	<!-- NEWS -->
	<div class="flex flex-column grow">
		<?php foreach ($allNews as $item) : ?>
			<?php if ($item['id'] == $_GET['id']) : ?>
				<div class="mb-5">
					<img class=" p-2 " src=<?php echo $item['urlToImage'] ?> alt="image">
					<h2 class="font-bold">
						<?php echo $item['title'] ?>
					</h2>
					<p>
						<?php echo $item['content']; ?>
					</p>
					<br>
					<a href="<?php echo $item['url']; ?>" target=_blank>Read more ...</a>
				</div>
			<?php endif; ?>
		<?php endforeach; ?>
	</div>
	<!-- LIKE BUTTONS -->
	<div class="flex flex-row mx-auto mb-5 justify-center">

		<a href="<?php
					if ($username) {
						echo '#';
					} else {
						echo  '/views/login.php';
					}
					?>">
			<form action="/components/likes_dislikes.php" method="POST"><button class="border rounded px-6 py-2 mx-2 bg-slate-200 hover:bg-slate-300">Like it... <i class="text-xl bi bi-hand-thumbs-up-fill "></i></button> </form>
		</a>
		<a href="<?php
					if ($username) {
						echo '#';
					} else {
						echo  '/views/login.php';
					}
					?>">
			<form action="/components/likes_dislikes.php" method="POST"><button class="border rounded px-6 py-2 mx-2 bg-slate-200 hover:bg-slate-300"><i class=" text-xl bi bi-hand-thumbs-down-fill"></i> ... or not</button> </form>
		</a>
	</div>

	<section class="mb-12">
		<a href="<?php
					if ($username) {
						echo '#';
					} else {
						echo  '/views/login.php';
					}
					?>">
			<h2 class="font-bold">Add a comment</h2>
		</a>

		<form action="" method="POST" class="flex flex-col">
			<div class="<?php echo (!$username) ? 'hidden' : '' ?> ">
				<textarea class="w-full border-2" name="comment" id="post" cols="30" rows="5" placeholder="You must be logged in to post ..."></textarea>
				<button class="border rounded w-48 px-6 py-2 my-3 mx-auto bg-slate-200 hover:bg-slate-300"><input type="submit" name="submit"></button>
			</div>
		</form>

		<!-- COMMENTS -->
		<div class="flex flex-col">
			<?php foreach ($users as $item) : ?>
				<!-- check if comment is not null and id of the news is the one from GET -->
				<?php if ($item['comment'] && $item['id_news'] == $newsId) : ?>
					<div class="flex items-center pt-4">

						<img src="<?php echo $item['profile_image']; ?>" alt="profile image" class="rounded-full mr-4 object-cover" style="width:48px; height:48px;">

						<p class="inline-block "><strong>
								<?php echo $item['username'] ?>
							</strong></p>

					</div>

					<p class="indent-4 pt-2">
						<?php echo $item['comment']; ?>
					</p>
					<div class="flex m-0 p-0 justify-end <?php echo (!$username) ? 'hidden' : '' ?>">
						<!-- LIKE -->
						<form action="/components/likes_dislikes.php" method="POST" class="">
							<button type="sumit" class="px-2 hover:text-green-500"><i class=" text-l bi bi-hand-thumbs-up-fill"></i></button>
						</form>
						<!-- DISLIKE -->
						<form action="/components/likes_dislikes.php" method="POST" class="">
							<button type="sumit" class="px-2 hover:text-green-500"><i class=" text-l bi bi-hand-thumbs-down-fill"></i></button>
						</form>


						<a href="../components/replay.php?commentId=<?= $item['id'] ?>&username=<?= $username ?>&id=<?= $newsId ?>" class="text-sm  text-grey-100 pb-4 ">Replay</a>
					</div>


					<div class=" <?php echo (!$username) ? 'hidden' : '' ?> flex">
						<?php if ($username == $item['username']) : ?>
							<a href="/views/update.php?id=<?= $newsId ?>&username=<?= $username ?>&commentId=<?= $item['id'] ?>" class="text-green-500 italic p-2 ">Edit</a>
							<form action="/components/delete.php" method='POST'>
								<input type="hidden" name='username' value="<?php echo $username; ?>">
								<input type="hidden" name='comment' value="<?php echo $item['id']; ?>">
								<button type="submit" class="text-red-500 italic p-2 ">Delete</button>
							</form>
						<?php endif ?>
					</div>

					<div class="flex justify-end  <?php echo (!$username) ? 'hidden' : '' ?> ">
						<!-- REPLAYS -->
						<div style="width:60%;" class=" ">
							<?php foreach ($replays as $replay) : ?>
								<!-- check if comment is not null and id of the news is the one from GET -->
								<?php if ($replay['replay'] && $item['id_news'] == $newsId && $item['id'] == $replay['comment_id']) : ?>
									<!-- <h1>OK</h1> -->
									<div class="flex items-center pt-4 w-2/3">

										<img src="<?php echo $replay['profile_image']; ?>" alt="profile image" class="rounded-full mr-4 object-cover" style="width:24px; height:24px;">

										<p class="inline-block "><strong>
												<?php echo $replay['username'] ?>
											</strong></p>

									</div>

									<p class="indent-4 pt-2">
										<?php echo $replay['replay']; ?>
									</p>
									<!-- LINKS -->
									<div class="flex justify-end">

										<!-- LIKE -->
										<form action="/components/likes_dislikes.php" method="POST" class="">
											<button type="sumit" class="px-2 hover:text-green-500"><i class=" text-l bi bi-hand-thumbs-up-fill"></i></button>
										</form>
										<!-- DISLIKE -->
										<form action="/components/likes_dislikes.php" method="POST" class="">
											<button type="sumit" class="px-2 hover:text-green-500"><i class=" text-l bi bi-hand-thumbs-down-fill"></i></button>
										</form>

										<a href='/components/replay.php?commentId=<?= $item['id'] ?>&username=<?= $username ?>&id=<?= $newsId ?>&replayId=<?= $replay['id'] ?>' class="text-sm text-grey-100 ">Replay
										</a>
									</div>

									<div class="<?php echo ($replay['username'] != $username) ? 'hidden' : '' ?>  flex ">

										<a href="/views/update.php?commentId=<?= $item['id'] ?>&username=<?= $username ?>&id=<?= $newsId ?>&replayId=<?= $replay['id'] ?>" class="text-green-500 italic p-2 inline">Edit</a>
										<form action="/components/delete.php" method='POST'>
											<input type="hidden" name='replay' value="<?php echo $replay['id']; ?>">
											<input type="hidden" name='username' value="<?php echo $username; ?>">
											<button type="submit" class="text-red-500 italic p-2 ">Delete</button>
										</form>

									</div>


								<?php endif ?>
							<?php endforeach ?>
						</div>
						<!-- END REPLAYS -->

					</div>

				<?php endif ?>
			<?php endforeach; ?>
		</div>

	</section>
</main>
<?php require_once "../components/footer.php"; ?>
</body>

</html>