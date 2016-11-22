<?php
  /*
  session_start();
^Set when page is tested individually
  */
  $username = $_GET['u'];
  if ($username != ""){
    $_SESSION['user_visiting'] = $username;
  }
  else { 
    $_SESSION['user_visiting'] = "";
    $username = $_SESSION['user'];
    header("Location: /pinder/profile/?u=".$username);
  }
?>
