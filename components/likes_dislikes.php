<?php
require_once '../components/header.php';

$username = $_SESSION['username'] ?? '';
$id_news = $_GET['id'] ?? '';
$comment_id = $_GET['commentId'] ?? '';
$replay_id = $_GET['replayId'] ?? '';

$news_like = $_POST['newsLike'] ?? '0';
$news_dislike = $_POST['newsDislike'] ?? '0';
$comment_like = $_POST['commentLike'] ?? '0';
$comment_dislike = $_POST['commentDislike'] ?? '0';
$replay_like = $_POST['replayLike'] ?? '0';
$replay_dislike = $_POST['replayDislike'] ?? '0';


// GET LOGED IN USER ID FROM DB
$query = $pdo->prepare("SELECT id FROM users WHERE username = '$username'");
$query->execute();
$user = $query->fetch(PDO::FETCH_ASSOC);
$id_user = $user['id'];

switch ($_SERVER['REQUEST_METHOD'] == "POST") {

        // INSERT LIKES IN DB
    case $news_like || $news_dislike;
        $nLikeDb = $pdo->prepare(
            "INSERT INTO like_dislike_news (thumbs_up, thumbs_down, id_user, id_news) 
    VALUES(:news_like, :news_dislike, :id_user, :id_news)
    ON DUPLICATE KEY UPDATE id_news = id_news;

    --     INSERT INTO like_dislike_replay (thumbs_up, thumbs_down, id_user, replay_id) 
    -- VALUES(:news_like, :news_dislike, :id_users, :replay_id)
    -- ON DUPLICATE KEY UPDATE replay_id = replay_id;
    "
        );
        $nLikeDb->bindValue(':news_like', $news_like);
        $nLikeDb->bindValue(':news_dislike', $news_dislike);
        $nLikeDb->bindValue(':id_user', $id_user);
        $nLikeDb->bindValue(':id_news', $id_news);
        $nLikeDb->execute();
        break;

    case $comment_like || $comment_dislike;
        $cLikeDb = $pdo->prepare(
            "INSERT INTO like_dislike_comments (thumbs_up, thumbs_down, id_user, comment_id) 
    VALUES(:comment_like, :comment_dislike, :id_user, :comment_id)
    ON DUPLICATE KEY UPDATE comment_id = comment_id;"
        );
        $cLikeDb->bindValue(':comment_like', $comment_like);
        $cLikeDb->bindValue(':comment_dislike', $comment_dislike);
        $cLikeDb->bindValue(':id_user', $id_user);
        $cLikeDb->bindValue(':comment_id', $comment_id);
        $cLikeDb->execute();
        break;

    case $replay_like || $replay_dislike;
        $rLikeDb = $pdo->prepare(
            "INSERT INTO like_dislike_replays (thumbs_up, thumbs_down, id_user, replay_id) 
    VALUES(:replay_like, :replay_dislike, :id_user, :replay_id)
    ON DUPLICATE KEY UPDATE replay_id = replay_id;
    "
        );
        $rLikeDb->bindValue(':replay_like', $replay_like);
        $rLikeDb->bindValue(':replay_dislike', $replay_dislike);
        $rLikeDb->bindValue(':id_user', $id_user);
        $rLikeDb->bindValue(':replay_id', $replay_id);
        $rLikeDb->execute();
        break;
}




header("Location: /views/details.php?id=$id_news&username=$username");

?>

Primary key from 2 columns
ALTER TABLE like_dislike_news ADD PRIMARY KEY (id_news, id_users);