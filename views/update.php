<?php
require '../components/header.php';

$newsId = $_GET['id'];
$commentId = $_GET['commentId'];
$replayId = $_GET['replayId'] ?? '';
// var_dump($replayId);
// echo '<pre>';
// var_dump($_GET['username']);
// var_dump($_GET['id']);
// var_dump($_GET['commentId']);
// echo '</pre>';
if ($replayId) {
   $replay = "update replay no $replayId";
   // GET REPLAY FRON DB
   $replayToEdit = $pdo->prepare("SELECT replay FROM replays WHERE id = :id ");
   $replayToEdit->bindValue(':id', $replayId);
   $replayToEdit->execute();
   $replay = implode($replayToEdit->fetch(PDO::FETCH_ASSOC));
   // echo '<pre>';
   // var_dump($replay);
   // echo '</pre>';

   // STORE UPDATED REPLAY
   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $editedReplay = $_POST['replay'] ?? '';
      if ($replay != $editedReplay) {

         $statement = $pdo->prepare("UPDATE replays SET replay = :replay WHERE id=$replayId");
         $statement->bindValue(':replay', $editedReplay);
         $statement->execute();
         $backToDetails = '/views/details.php?id=' . $newsId . '&username=' . $username;
         header('Location: ' . $backToDetails);
      }
   }
} else {
   // GET COMMENT FRON DB
   $commentToEdit = $pdo->prepare("SELECT comment FROM comments WHERE id = :id ");
   $commentToEdit->bindValue(':id', $commentId);
   $commentToEdit->execute();
   $comment = implode($commentToEdit->fetch(PDO::FETCH_ASSOC));
   // echo '<pre>';
   // var_dump($comment);
   // echo '</pre>';

   // STORE UPDATED COMMENT
   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $editedComment = $_POST['comment'] ?? '';
      if ($comment != $editedComment) {

         $statement = $pdo->prepare("UPDATE comments SET comment = :comment WHERE id=$commentId");
         $statement->bindValue(':comment', $editedComment);
         $statement->execute();
         $backToDetails = '/views/details.php?id=' . $newsId . '&username=' . $username;
         header('Location: ' . $backToDetails);
      }
   }

   // echo '<pre>';
   // var_dump($editedComment);
   // echo '</pre>';
}

?>



<main class="container w-4/5 mx-auto grow">
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
   <div class="flex flex-row mx-auto mb-5 justify-center">
      <button class="border rounded px-6 py-2 mx-2 bg-slate-200 hover:bg-slate-300">Like it... <i class="text-xl bi bi-hand-thumbs-up-fill "></i></button>
      <button class="border rounded px-6 py-2 mx-2 bg-slate-200 hover:bg-slate-300"><i class=" text-xl bi bi-hand-thumbs-down-fill"></i> ... or not</button>
   </div>

   <section class="mb-12">

      <h2 class="font-bold">Edit
         <?= $replayId ? "replay" : "comment" ?>
      </h2>

      <form action="" method="POST" class="flex flex-col">
         <div class="<?php echo (!$username) ? 'hidden' : '' ?> ">
            <textarea class="w-full border-2" name="<?= $replayId ? 'replay' : 'comment' ?>" id="post" cols="30" rows="5" placeholder="You must be logged in to post ..."><?= $replayId ? $replay : $comment ?></textarea>
            <button class="border rounded w-48 px-6 py-2 my-3 mx-auto bg-slate-200 hover:bg-slate-300"><input type="submit" name="submit"></button>
         </div>
      </form>
   </section>
</main>


<?php require_once "../components/footer.php"; ?>