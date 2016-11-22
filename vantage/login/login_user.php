<?php
	session_start();
	error_reporting(-1);
	ini_set('display_errors', 'On');
	include '../conn.php';

	$username = mysqli_real_escape_string($conn, $_POST["username"]);
	$password = mysqli_real_escape_string($conn, $_POST["password"]);

	/*$isTemporaryQuery = mysqli_query($conn, "SELECT isTemporary FROM users WHERE username='$username'");
	$result = mysqli_fetch_assoc($isTemporaryQuery);
	$isTemporary = $result["isTemporary"];
	if ($isTemporary == 1) {
		//value is true, continue processing user with reset password page.

		$_SESSION["temp_pwd"] = $username;
		header('Location: reset_password.php');
	} else {
		echo $isTemporary;
	}*/

	$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";

	$result = mysqli_query($conn, $query);
	$user_data = mysqli_fetch_assoc($result);
	$check_user = mysqli_num_rows($result);

	if ($check_user > 0) {
		echo "Logged In";
		$_SESSION['user'] = $username;
		echo "<br>".$_SESSION['user'];

		if ($user_data["isTemporary"] == 1) {
			//temporary password
			$_SESSION['tmp_pwd'] = $user_data['username'];
			header("Location: reset_password.php");

		} else {
			header('Location: ../');
		}

		exit();
	} else {
		header("Location: index.php?action=bad_login");
	}

?>
