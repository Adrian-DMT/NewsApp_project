<?php

require_once "../components/header.php";

$newsId = $_GET['id'];

$commentId = $_GET['commentId'];
$replayId = $_GET['replayId'] ?? '';

$replay = $_POST['replay'] ?? '';


//GET user_id FROM DB
$dataUser = $pdo->prepare("SELECT id  FROM users WHERE username = '$username'");
$dataUser->execute();
$userId = $dataUser->fetch(PDO::FETCH_ASSOC);
//var_dump($userId);

// GET COMMENTS FROM DB
$dataComment = $pdo->prepare("SELECT id, comment FROM comments");
$dataComment->execute();
$comments = $dataComment->fetchAll(PDO::FETCH_ASSOC);

// GET REPLAYS FROM DB
$dataReplay = $pdo->prepare("SELECT id, replay FROM replays");
$dataReplay->execute();
$replays = $dataReplay->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   if ($replay) {
      // PUT REPLAY INTO DB
      $saveReplay = $pdo->prepare('INSERT INTO replays (replay, comment_id, id_user) VALUES(:replay,:comment_id,:id_user)');

      $saveReplay->bindValue(':replay', $replay);
      $saveReplay->bindValue(':comment_id', $commentId);
      $saveReplay->bindValue(':id_user', $userId['id']);
      $saveReplay->execute();

      header("Location: ../views/details.php?id=$newsId&username=$username");
   } else {
      header("Location: ../views/details.php?id=$newsId&username=$username");
   }
}


// echo '<pre>';
// var_dump($replays);
// echo '</pre>';
?>



<main class="container w-4/5 mx-auto ">

   <form action="" method="POST" class="   ">
      <div class=" flex flex-col justify-around ">
         <h1 class="mx-auto pb-4 text-2xl "><span class="font-bold">Replay to :</span>

            <?php if ($replayId == '') : ?>
               <?php foreach ($comments as $comment) : ?>
                  <?php if ($comment['id'] == $commentId) : ?>
                     "<?= $comment['comment']  ?>"
                     <?php break; ?>
                  <?php endif; ?>
               <?php endforeach ?>

            <?php else : ?>
               <?php foreach ($replays as $replay) : ?>
                  <?php if ($replay['id'] == $replayId) : ?>
                     "<?= $replay['replay'] ?>"
                     <?php break; ?>
                  <?php endif ?>
               <?php endforeach ?>
            <?php endif ?>
         </h1>
         <textarea class="w-full border-2 " name="replay" id="post" cols="30" rows="5" placeholder="You must be logged in to post ..."></textarea>
         <button class="border rounded w-48 px-6 py-2 my-3 mx-auto bg-slate-200 hover:bg-slate-300"><input type="submit" name="submit"></button>
      </div>
   </form>


</main>

<?php require_once "../components/footer.php"; ?>