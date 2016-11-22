<?php

  //session_start();

  error_reporting(E_ALL);
  ini_set('display_errors', 1);

  include "conn.php";

  $username = $_SESSION['user'];

  $get_user_query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
  $result = mysqli_fetch_assoc($get_user_query);
  $school = $result["school"];
  $district = $result["district"];
  $username = $result["username"];

  $query = mysqli_query($conn, "SELECT * FROM posts WHERE school='$school' AND district='$district' ORDER BY id DESC");

?>
