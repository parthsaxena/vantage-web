<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$user_sent_to_query = mysqli_query($conn, "SELECT posted_by FROM posts WHERE id = '$id' ");
$user_sent_to_result = mysqli_fetch_assoc($user_sent_to_query);
$user_sent_to = $user_sent_to_result['posted_by'];

$user_int_query = mysqli_query($conn, "SELECT id FROM users WHERE username = '$user_sent_to' ");
$user_int_result = mysqli_fetch_assoc($user_int_query);
$user_int = $user_int_result['id'];

if (!$user_int_query){
  echo $mysqli->error;
}

$content = $_POST['content'];
$post_id = $_GET['id'];

$query = mysqli_query($conn, "INSERT INTO comments (posted_by, content, post_id, user_sent_to)
VALUES ('$user', '$content', '$post_id', '$user_int') ");
?>
