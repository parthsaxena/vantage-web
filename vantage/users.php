<?php 
include "conn.php";

$query = mysqli_query($conn, "SELECT * FROM users");
$num_users = mysqli_num_rows($query);

echo "Number of Users: ".$num_users;
?>