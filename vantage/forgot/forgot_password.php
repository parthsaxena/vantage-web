<?php

	include '../conn.php';

	$email = mysqli_real_escape_string($conn, $_POST["email"]);

	$check_query = "SELECT * FROM users WHERE email='$email'";
	$check_result = mysqli_query($conn, $check_query);
	$check_rows = mysqli_num_rows($check_result);

	$allchars = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0'];

	function sendMail($to, $password) {

		$headers = 'From: noreply@scapter.org' . "\r\n" .
		'Reply-To: noreply@scapter.org' . "\r\n" .
		'X-Mailer: PHP/' . phpversion();

		$subject = "Password Reset Request for Pinder";
		$msg = "You have requsted to reset your password for Pinder. This is your temporary password: '" . $password . "'. You will have to change it next time you login.";
		mail($to, $subject, $msg, $headers);
	}

	if ($check_rows > 0) {

		$temppwd = "";
		for ($x = 1; $x < 9; $x++) {
			$randnum = rand(1, 36);
			$temppwd = $temppwd . $allchars[$randnum];
		}

		$change_password_update = "UPDATE users SET password='$temppwd' WHERE email='$email'";
		$change_password = mysqli_query($conn, $change_password_update);
		$setIfTemporary = mysqli_query($conn, "UPDATE users SET isTemporary=TRUE WHERE email='$email'");

		sendMail($email, $temppwd);
		echo "Password Updated. Please check email to get new password and login again.";

	} else {
		echo "Sorry, but there is no account associated with that email address!";
	}

?>
