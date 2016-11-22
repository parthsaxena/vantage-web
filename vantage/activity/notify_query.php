<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$user_int_query = mysqli_query($conn, "SELECT id FROM users WHERE username = '$user' ");
$user_int_result = mysqli_fetch_assoc($user_int_query);
$user_int = $user_int_result['id'];

echo $loggedIn_int;

$query = mysqli_query($conn, "SELECT * FROM comments WHERE user_sent_to = '$user_int' ORDER BY id DESC LIMIT 5");

$read_query = mysqli_query($conn, "SELECT * FROM comments WHERE user_sent_to = '$user_int' ");
?>
