<html>
    
    <head>
        <title>Vantage | Register</title>
        
        <link rel="stylesheet" type="text/css" href="css/login.css">
        
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
        </script>
        
    </head>
    
    <body class="background">
        
        <center class="container">
            <h1>Vantage</h1>
            
            <input class="register_elements" type="text" placeholder="Email" id="email"><br><br>
            <input class="register_elements" type="password" placeholder="Password" id="password"><br><br>
            <button onclick="login_user()" type="submit">Log In</button>
        
        <script> 
            
            function login_user() {
                var email = document.getElementById("email").value;
                var password = document.getElementById("password").value;
                
                firebase.auth().signInWithEmailAndPassword(email, password).catch(function(error){
                    //Catching Errors
                    var errorCode = error.code;
                    var errorMessage = error.message;
                
                    alert(errorMessage);
                });
                
            }
            
            var user = ref.getAuth();
                
            if (user = null){
                document.write("Not logged in");
            }
            
        </script>  
            
        </center>
    </body>
    
</html>