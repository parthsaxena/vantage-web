<script src="https://www.gstatic.com/firebasejs/3.2.0/firebase.js"></script>
        <script src="main.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

<script>
    
    function logout_user(){
        firebase.auth().signOut().then(function() {
           console.log("Success");
        }, function(error) {
           console.log("Error");
        });
    }
    
</script>
<ul style="padding-bottom: 10px;">
                    <center>
                    
                    <center>
                    <div style="float: left; margin-left: 70px;">
                    <li> 
                        <a class="active" href="/" style="position: relative; top: 20px;"><img src="logo_black.png" height="70"></a>
                        
                            <!--<td><input type="text" style="height: 40px; width: 250%; padding-left: 15px; font-family: Roboto; font-size: 15px; background-color: #F5F5F5; color: black; position: relative; top: 30px; border: none; border-radius: 2px; opacity: 1; left: 10px;" placeholder="Search for subjects..."></td>-->
                        </li>
                        
                        <li><a href="/" style="position: relative; top: 45px;" id="1">Your Questions</a></li>
                    <li><a href="subjects.php" style="position: relative; top: 45px;" id="2">Answer Questions</a></li>
                        
                    </div>
                    <div style="position: relative; top: 45px; float: right; margin-right: 150px;">
                        <!--<li><a id="3">Your Profits</a></li>-->
                        <li><a href="settings.php" id="4">Account Settings</a></li>
                        <li><a id="user" onclick="logout_user();" id="5">Sign Out</a></li>
                    </div>
                        </center>
                    </center>
                    
                </ul>