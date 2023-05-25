<?php
$news_likes = $_POST['comment_likes'] ?? '';
$news_dislikes = $_POST['comment_dislikes'] ?? '';

$comment_likes = $_POST['comment_likes'] ?? '';
$comment_dislikes = $_POST['comment_dislikes'] ?? '';

$replay_likes = $_POST['replay_likes'] ?? '';
$replay_dislikes = $_POST['replay_dislikes'] ?? '';

var_dump($news_likes, $news_dislikes);
var_dump($comment_likes, $comment_dislikes);
var_dump($replay_likes, $replay_dislikes);
