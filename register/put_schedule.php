<?php
include('../conn.php');
session_start();

$user_id = $_SESSION['user_id'];
$name = $_SESSION['name'];
$username = $_SESSION['user'];
$password = $_SESSION['pw'];
$email = $_SESSION['email'];
$school = $_SESSION['school'];
$district = $_SESSION['district'];

$query = mysqli_query($conn, "");

$_SESSION['first_period'] = $_POST['first_period'];
$_SESSION['second_period'] = $_POST['second_period'];
$_SESSION['third_period'] = $_POST['third_period'];
$_SESSION['fourth_period'] = $_POST['fourth_period'];
$_SESSION['fifth_period'] = $_POST['fifth_period'];
$_SESSION['sixth_period'] = $_POST['sixth_period'];
$_SESSION['seventh_period'] = $_POST['seventh_period'];
$_SESSION['eighth_period'] = $_POST['eighth_period'];

header("Location: input_teachers.php");

?>
