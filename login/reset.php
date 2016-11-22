<?php

session_start();

include '../conn.php';

if (!isset($_SESSION['temp_pwd'])) {
  //no session
  header('Location: index.php');
}

$email = $_POST['email'];
$password = $_POST['password'];
$confirm = $_POST['confirm'];

if ($password != $confirm) {
    header("Location: reset_password.php");
}

$update_password_query = mysqli_query($conn, "UPDATE users SET password='$password' WHERE email='$email'")
$update_temporary_query = mysqli_query($conn, "UPDATE users SET isTemporary=0 WHERE email='$email'")

if (!$update_password_query || !$update_temporary_query) {
    echo 'ERROR. Please try again later or contact us for help at support@scapter.org if the problem persists.';
} elseif($update_password_query && $update_temporary_query){
  header('Location: ../');
}

?>
