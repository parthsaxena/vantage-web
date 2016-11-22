<?php

session_start();

if (!isset($_SESSION['tmp_pwd'])) {
  //no session, redirect

  header('Location: index.php');

}
?>

<form action="reset.php" method="POST">
    Email: <input type="text" name="email"><br>
    Password: <input type="password" name="password"><br>
    Confirm Password: <input type="password" name="confirm"><br>
    <input type="submit">
</form>
