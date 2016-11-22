<html>
	
	<head>
		<title>Pinder - Forgot</title>
	
		<link rel="stylesheet" href="../css/bootstrap.css">
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/simple-sidebar.css">
		<link rel="stylesheet" href="../css/login_register.css">
	</head>
	
	<body>
		<center>
			<img class="logo" src="../images/logo.png" alt="Pinder">
			
			<br><br>
			<div class='forgot'>
				<br>
				<img class="profile_picture img-circle"src="../images/empty_profile_picture.jpg">	<br><br>
				<p>Don't worry, it happens to the best of us.</p>
				<p>We will send an email with a temporary password to the email address associated with your account.</p>
				<form method="POST" action="forgot_password.php">
					<input type="text" placeholder="Email..." name="email"><br><br>
					<button type="submit" class="btn btn-info login-submit">Submit</button>
				</form>
				
			</div>
			
		</center>
	</body>
	
</html>