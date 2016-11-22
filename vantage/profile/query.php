<?php
$district_query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
$result = mysqli_fetch_assoc($district_query);
$school = $result['school'];
$district = $result['district'];
$fullname = $result['fullname'];
$profile_picture = $result['profile_picture'];
$user_id = $result['user_id'];
?>
