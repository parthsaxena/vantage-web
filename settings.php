<html>
    
    <head>
         
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link href='https://fonts.googleapis.com/css?family=Roboto:100' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
        <title>Vantage</title>
        
        <script src="https://www.gstatic.com/firebasejs/3.2.0/firebase.js"></script>
        <script src="main.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        
        <script> 
            function reset_password(){
                var new_password = document.getElementById("new_password").value;
                
                var user = firebase.auth().currentUser;
                console.log(user.email);
                //var newPassword = getASecureRandomPassword();

                user.updatePassword(new_password).then(function() {
                    alert("Your password has been reset.");
                }, function(error) {
                    alert("There was an error reseting your password.");
                });
            }
        </script>
        
    </head>
    
    <body style="font-family: Roboto; background-color: #EEEEEE;">
        <div id="header">
            <?php include "header.php"; ?>
        </div>
    <!--<center id="shadow"><br><br><br><br><p id="content" style="font-size: 30px;"></p>
            To change your password, you must <a href="re-auth.php" style="color: green; text-decoration: underline;">sign in</a> again with your current credentials. If you don't do so, there will be an error changing your password.<br><br>
            <label for="new_password" style="font-size: 17px;">Reset Password</label><br><br>
          <!--<input type="text" id="old_password" class="textbox" placeholder="Old Password..." style="width: 50%;"><br><br>
          <input type="text" id="new_password" class="textbox" placeholder="New Password..." style="width: 50%;"><br><br>
            <button class="button" onclick="reset_password()">Reset</button>
        </center>-->
        <br><br><br><br><center><div class="card_light_shadow" style="padding: 10px;">To edit your account settings, download the iOS or Android app for Vantage.</div></center>
    </body>
    
</html>