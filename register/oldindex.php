<html>
  <head>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/simple-sidebar.css">
    <link rel="stylesheet" href="../css/login_register.css">
    <title>Pinder- Register</title>
  </head>
  <body>
  <center>
    <img src="../images/logo.png" class='logo'><br><br>
    <div class='register'>

        <br><img src="../images/empty_profile_picture.jpg" class='profile_picture img-circle'>
        <br>
        <br>
        <form method="POST" action="register_user.php">
          <input type="text" name="fullname" placeholder="Full Name..."><br>
          <input type="text" name="username" placeholder="Username..."><br>
          <input type="text" name="email" placeholder="Email..."><br>
          <input type="password" name="password" placeholder="Password..."><br>
          <input type="text" name="school" placeholder="School..."><br>
          <input type="text" name="district" placeholder="District..."><br>

          <button type="submit" class="btn btn-info">Register</button>
        </form><br>
		<a href="../login">Already have an account?</a>
        <br>
        <br>
    </div>
  </center>
  </body>
</html>
