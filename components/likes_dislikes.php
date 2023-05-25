<?php
require_once '../components/header.php';

$username = $_SESSION['username'];
$id_news = $_GET['id'];

$news_like = $_POST['news_likes'] ?? '';
$news_dislike = $_POST['news_dislikes'] ?? '';

$comment_like = $_POST['comment_likes'] ?? '';
$comment_dislike = $_POST['comment_dislikes'] ?? '';

$replay_like = $_POST['replay_likes'] ?? '';
$replay_dislike = $_POST['replay_dislikes'] ?? '';

// var_dump($news_like, $news_dislike);
// var_dump($comment_like, $comment_dislike);
// var_dump($replay_like, $replay_dislike);

// GET LOGED IN USER ID FROM DB
$query = $pdo->prepare("SELECT id FROM users WHERE username = '$username'");
$query->execute();
$user = $query->fetch(PDO::FETCH_ASSOC);


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id_users = $user['id'];
    $news_like = $_POST['newsLike'] ?? '0';
    $news_dislike = $_POST['newsDislike'] ?? '0';
    var_dump($news_like, $news_dislike, $id_users, $id_news);
    // INSERT LIKES IN DB
    $dbLike = $pdo->prepare("INSERT INTO like_dislike_news (thumbs_up, thumbs_down, id_users, id_news) 
    VALUES(:news_like, :news_dislike, :id_users, :id_news)
    ON DUPLICATE KEY UPDATE id_news = id_news");
    $dbLike->bindValue(':news_like', $news_like);
    $dbLike->bindValue(':news_dislike', $news_dislike);
    $dbLike->bindValue(':id_users', $id_users);
    $dbLike->bindValue(':id_news', $id_news);
    $dbLike->execute();
}



header("Location: /views/details.php?id=$id_news&username=$username");

?>

Primary key from 2 columns
ALTER TABLE like_dislike_news ADD PRIMARY KEY (id_news, id_users);