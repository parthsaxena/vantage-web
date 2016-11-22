<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("../conn.php");
session_start();
$username = $_GET['u'];
if ($username != ""){
  $_SESSION['user_visiting'] = $username;
}
else {
  $_SESSION['user_visiting'] = "";
  $username = $_SESSION['user'];
  header("Location: /profile/schedule.php?u=".$username);
}
echo $username."<br>";
$query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
$results = mysqli_fetch_assoc($query);

$firstPeriod = $results['first_period'];
$secondPeriod = $results['second_period'];
$thirdPeriod = $results['third_period'];
$fourthPeriod = $results['fourth_period'];
$fifthPeriod = $results['fifth_period'];
$sixthPeriod = $results['sixth_period'];
$seventhPeriod = $results['seventh_period'];
$eightPeriod = $results['eight_period'];

?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Pinder</title>
    </head>
    <body>
        <?php

            echo "First Period: $firstPeriod<br>";
            echo "Second Period: $secondPeriod<br>";
            echo "Third Period: $thirdPeriod<br>";
            echo "Fourth Period: $fourthPeriod<br>";
            echo "Fifth Period: $fifthPeriod<br>";
            echo "Sixth Period: $sixthPeriod<br>";
            echo "Seventh Period: $seventhPeriod<br>";
            echo "Eight Period: $eightPeriod<br>";

         ?>
    </body>
</html>
