<?php

	include '../conn.php';

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	session_start();

	$fullname = mysqli_real_escape_string($conn, $_POST["fullname"]);
	$username = mysqli_real_escape_string($conn, $_POST["username"]);
	$email = mysqli_real_escape_string($conn, $_POST["email"]);
	$password = mysqli_real_escape_string($conn, $_POST["password"]);
	$school = mysqli_real_escape_string($conn, $_POST["school"]);
	$district = mysqli_real_escape_string($conn, $_POST["district"]);
	$user_id = hash('ripemd160', $username);
    $profile_picture = "http://scapter.org/pinder/images/empty_profile_picture.jpg";

	if (strlen($username) < 8 || strlen($password) < 8 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
			echo "Sorry, but your email seems to be invalid.";
		}elseif (strlen($username) < 8) {
			echo "Sorry, but your username must be at least 8 characters!";
		} elseif(strlen($password) < 8) {
			echo "Sorry, but your password must be at least 8 characters!";
		} else {
			echo "Something else went wrong... Please try again later... ";
		}
	} else {

		$query = "INSERT INTO users (fullname, username, password, school, email, district, user_id, profile_picture) VALUES ('$fullname', '$username', '$password', '$school', '$email', '$district', '$user_id', '$profile_picture')";

		$check_query = "SELECT * FROM users WHERE username='$username' OR email='$email'";
		$check_result = mysqli_query($conn, $check_query);
		$check_rows = mysqli_num_rows($check_result);

		if ($check_rows > 0) {
			echo "Sorry, but it appears this username is taken, or this email is already in use!";
		} else {

			$result = mysqli_query($conn, $query);

			//if (!$result) {
				//echo "Error " . mysqli_error();
			//} else {
				echo "Successfully Registered.";

				$_SESSION['name'] = $fullname;
				$_SESSION['user'] = $username;
				$_SESSION['pw'] = $password;
				$_SESSION['email'] = $email;
				$_SESSION['school'] = $school;
				$_SESSION['district'] = $district;
				$_SESSION['user_id'] = $user_id;

				//Code below is for the user's schedule
                //$_SESSION['register-stage'] = "1";
				//header('Location: ./input_schedule.php');
                header("Location: ../");
			//}
		}
	}
?>
