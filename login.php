<html>
    
    <head>
        <title>Vantage | Login</title>
        
        <link rel="stylesheet" type="text/css" href="css/style.css">
        
        <script src="https://www.gstatic.com/firebasejs/3.1.0/firebase.js"></script>

        <script>
        // Initialize Firebase
        var config = {
            apiKey: "AIzaSyA62_N7yggbFRkiX5e291axflf-CYDAM3E",
            authDomain: "vantage-e9003.firebaseapp.com",
            databaseURL: "https://vantage-e9003.firebaseio.com",
            storageBucket: "vantage-e9003.appspot.com",
        };
        firebase.initializeApp(config);
            
        firebase.auth().onAuthStateChanged(function(user) {
            if (user) {
                location.href = "/";
            } 
            else {

            }
        });
        </script>
        
    </head>
    
    <style>
        .container {
            margin-right: -50px;
            padding-right: 50px;
            margin-left: -50px;
            padding-left: 50px;
            margin-top: -50px;
            padding-top: 100px;
        }
        
        .inv {
           background: rgba(54, 25, 25, .3);
        }
    </style>
    
    <body class="background">
        
        <center class="container" style="background-color: #EEE; position: fixed; background-size: cover; background-repeat: no-repeat; background-position: center center; height: 100%; width: 100%;">
            <div class="card_no_hover" style="">
            <p style="font-family: Roboto; font-size: 45px; color: white; opacity: 1;"><img src="logo_black.png" height="45"></p><p style="font-family: Roboto; font-size: 20px; color: black; position: relative; bottom: 30px;">School work made easy</p>
            <div style="position: relative; bottom: 20px;">
            <!--<div style="text-decoration: underline;">Login</div><br>-->
            <input class="textbox" type="text" placeholder="Email" id="email" style="width: 70%;"><br><br>
            <input class="textbox" type="password" placeholder="Password" id="password" style="width: 70%;"><br><br><br>
            <button onclick="login_user()" type="submit" class="button" style="color: white;">Log In</button><br><br>
                <a style="color: grey;" href="register.php" type="submit">Don't have an account?</a><br><p id="message" style="color: #FF7043;"></p></div></div>
        
        <script> 
            
            function login_user() {
                var email = document.getElementById("email").value;
                var password = document.getElementById("password").value;
                
                firebase.auth().signInWithEmailAndPassword(email, password).catch(function(error){
                    //Catching Errors
                    var errorCode = error.code;
                    var errorMessage = error.message;
                
                    //alert(errorMessage);
                    document.getElementById('message').innerHTML = errorMessage;
                    
                    firebase.auth().onAuthStateChanged(function(user) {
                });
                    
                });
                
                    firebase.auth().onAuthStateChanged(function(user) {
                        if (user) {
                            location.href = "/";
                        } 
                        else {

                        }
                });
                                                       
            }
            
        </script>  
            
        </center>
    </body>
    
</html>