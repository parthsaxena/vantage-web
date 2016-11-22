<?php
session_start();
include 'conn.php';
error_reporting(-1);
ini_set('display_errors', 'On');
if (!(isset($_SESSION['user']) && $_SESSION['user'] != '')) {
	header ("Location: /vantage/login");
	echo "Something went wrong.";
}
else {
	//echo "Session in progress.";
}
$user = $_SESSION['user'];
?>
