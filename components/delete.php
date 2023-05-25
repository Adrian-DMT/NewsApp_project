<?php
require_once "../components/data-api.php";
require_once "../components/data-db.php";

$replayId = $_POST['replay'] ?? '';
$commentId = $_POST['comment'] ?? '';
$username = $_POST['username'];

if ($replayId == '') {
   // REMOVE COMMENT
   $queryComments = $pdo->prepare("DELETE FROM comments WHERE id = :id");
   $queryComments->bindValue(':id', $commentId);
   $queryComments->execute();
} else {
   // REMOVE REPLAY
   $queryReplays = $pdo->prepare("DELETE FROM replays WHERE id = :id");
   $queryReplays->bindValue(':id', $replayId);
   $queryReplays->execute();
}

header('Location: /views/index.php?username=' . $username);
