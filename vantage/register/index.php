<?php
	include '../conn.php';
?>

<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Vantage - Register</title>

        <style>
        /* NOTE: The styles were added inline because Prefixfree needs access to your styles and they must be inlined if they are on local disk! */
        @import url(http://fonts.googleapis.com/css?family=Exo:100,200,400);
        @import url(http://fonts.googleapis.com/css?family=Source+Sans+Pro:700,400,300);

        body{
        	margin: 0;
        	padding: 0;
        	background: #fff;

        	color: #fff;
        	font-family: Exo;
        	font-size: 12px;
        }

        .body{
        	position: absolute;
        	top: -20px;
        	left: -20px;
        	right: -40px;
        	bottom: -20px;
        	width: auto;
        	height: auto;
        	background-image: url(http://vantage.social/vantage/login/images/bg.jpeg);
        	background-size: cover;
        	-webkit-filter: blur(5px);
        	z-index: 0;
        }

				.night{
		        	position: absolute;
		        	top: -20px;
		        	left: -20px;
		        	right: -40px;
		        	bottom: -40px;
		        	width: auto;
		        	height: auto;
		        	background-image: url(http://vantage.social/vantage/images/bg/night/night-1.jpeg);
		        	background-size: cover;
		        	-webkit-filter: blur(5px);
		        	z-index: 0;
		        }

		    .day{
		    	position: absolute;
		    	top: -20px;
	      	left: -20px;
        	right: -40px;
	      	bottom: -40px;
					width: auto;
	      	height: auto;
	      	background-image: url(http://scapter.org/images/bg/day/day-1.jpeg);
		    	background-size: cover;
		    	-webkit-filter: blur(5px);
	      	z-index: 0;
        }

        .grad{
        	position: absolute;
        	top: -20px;
        	left: -20px;
        	right: -40px;
        	bottom: -40px;
        	width: auto;
        	height: auto;
        	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(0,0,0,0)), color-stop(100%,rgba(0,0,0,0.65))); /* Chrome,Safari4+ */
        	z-index: 1;
        	opacity: 0.7;
        }

        .header{
        	position: absolute;
        	top: calc(50% - 35px);
        	left: calc(50% - 255px);
        	z-index: 2;
        }

        .header div{
        	float: left;
        	color: #fff;
        	font-family: 'Exo', sans-serif;
        	font-size: 35px;
        	font-weight: 200;
        }

        .header div span{
        	color: #FF0000 !important;
        }

        .login{
        	position: absolute;
        	top: calc(50% - 75px);
        	left: calc(50% - 50px);
        	height: 150px;
        	width: 350px;
        	padding: 10px;
        	z-index: 2;
        }

        .login input[type=text]{
        	width: 250px;
        	height: 30px;
        	background: transparent;
        	border: 1px solid rgba(255,255,255,0.6);
        	border-radius: 2px;
        	color: #fff;
        	font-family: 'Exo', sans-serif;
        	font-size: 16px;
        	font-weight: 400;
        	padding: 4px;
					margin-top: 10px;
        }

        .login input[type=password]{
        	width: 250px;
        	height: 30px;
        	background: transparent;
        	border: 1px solid rgba(255,255,255,0.6);
        	border-radius: 2px;
        	color: #fff;
        	font-family: 'Exo', sans-serif;
        	font-size: 16px;
        	font-weight: 400;
        	padding: 4px;
					margin-top: 10px;
        }

				#already_have_account {
					padding: 4px;
					font-family: 'Exo', sans-serif;
        	font-size: 16px;
        	font-weight: 400;
					color: #00802b;
					text-decoration: none;
				}

				#already_have_account:hover {
					font-family: 'Exo', sans-serif;
        	font-size: 16px;
        	font-weight: 400;
					color: #00cc45;
					text-decoration: none;
				}

        .login input[type=submit]{
        	width: 260px;
        	height: 35px;
        	background: #fff;
        	border: 1px solid #fff;
        	cursor: pointer;
        	border-radius: 2px;
        	color: #a18d6c;
        	font-family: 'Exo', sans-serif;
        	font-size: 16px;
        	font-weight: 400;
        	padding: 6px;
        	margin-top: 10px;
        }

        .login input[type=submit]:hover{
        	opacity: 0.8;
        }

        .login input[type=submit]:active{
        	opacity: 0.6;
        }

        .login input[type=text]:focus{
        	outline: none;
        	border: 1px solid rgba(255,255,255,0.9);
        }

        .login input[type=password]:focus{
        	outline: none;
        	border: 1px solid rgba(255,255,255,0.9);
        }

        .login input[type=submit]:focus{
        	outline: none;
        }

        ::-webkit-input-placeholder{
           color: rgba(255,255,255,0.6);
        }

        ::-moz-input-placeholder{
           color: rgba(255,255,255,0.6);
        }
    </style>


        <script src="js/prefixfree.min.js"></script>


  </head>

  <body>

    <div class="body"></div>
		<div class="grad"></div>
		<div class="header">
			<div><span>Vantage</span></div>
		</div>
		<br>
		<div class="login">
				<form method="POST" action="register_user.php">
					<input type="text" placeholder="full name" name="fullname"><br>
					<input type="text" placeholder="username" name="username"><br>
					<input type="text" placeholder="email" name="email"><br>
					<input type="text" placeholder="school" name="school"><br>
					<input type="text" placeholder="district" name="district"><br>
					<input type="password" placeholder="password" name="password"><br><br>
                   By Creating An Account, You Are Explicitly Agreeing to the <a href="http://vantage.social/vantage/eula.html" target="_blank" style="color: red; font-family: Arial">EULA</a><br>
					<input type="submit" value="Register">
				</form><br><br>

				<center><a href="../login" id="already_have_account">...Already Have an Account?</a></center>

		</div>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

		<script>
			var currentTime = new Date();
			var hours = currentTime.getHours();
			var minutes = currentTime.getMinutes();

			if (hours <= 18) {
				 document.write("<div class='day'></div>");
			}
			else {
					document.write("<div class='night'></div>");
			}
		</script>

  </body>
</html>
