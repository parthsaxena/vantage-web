<?php

  //session_start();
  $id = $_GET['id'];
  error_reporting(E_ALL);
  ini_set('display_errors', 1);

  include "conn.php";

  $query = mysqli_query($conn, "SELECT * FROM posts WHERE id='$id' ORDER BY id DESC");

?>
