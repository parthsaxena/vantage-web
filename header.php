<html>
    <head>
        <title>Vantage</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto:100" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
         <script src="https://www.gstatic.com/firebasejs/3.2.0/firebase.js"></script>
        <script>

            function note(){
                $("#note").toggle();
            }

            // Initialize Firebase
            var config = {
                apiKey: "AIzaSyA62_N7yggbFRkiX5e291axflf-CYDAM3E",
                authDomain: "vantage-e9003.firebaseapp.com",
                databaseURL: "https://vantage-e9003.firebaseio.com",
                storageBucket: "vantage-e9003.appspot.com",
            };
            firebase.initializeApp(config);

            $(document).ready(function() {
                //$("#side").show();
                $("#asking_box").hide();
                $("#ask_ask").hide();
                $("#question_box").hide();
            });

            function change_search(){
                document.getElementById("q").placeholder = "Type in Subject";
            }

            function toggle(){
                $("#side").toggle();
            }

            function ask(){
                $("#asking_box").toggle();
            }

            function ask_next(){
                $("#ask_subject").hide();
                $("#ask_ask").show();
            }

            function display_ts(date_posted) {
                var time_elapsed = Date.now() - date_posted;
                var minutes = Math.round(time_elapsed/60000);
                var hours = minutes/60;
                var days = Math.round(hours/24);
                var weeks = Math.round(days/7);
                var years = Math.round(weeks/52);

                var tsStr = 'a moment ago';

                if (years > 1) {
                    tsStr = years + ' years ago';
                } else if (weeks > 1) {
                    tsStr = weeks + ' weeks ago';
                } else if (days > 1) {
                    tsStr = days + ' days ago';
                } else if (hours > 1){
                    var rHours = Math.floor(hours);
                    var rMinutes = minutes % 60;
                    tsStr = rHours + 'h, ' + rMinutes + 'm ago';
                } else if (minutes > 1){
                    tsStr = minutes + ' min ago';
                } else if (minutes < 1){
                    return tsStr;
                }

                return tsStr;
            }

            function check_user() {
                // Check if user is logged in
                firebase.auth().onAuthStateChanged(function(user) {

                    var uid;

                    var current_user = firebase.auth().currentUser;
                    var email = current_user.email;
                    var uid = current_user.uid;
                    //alert(uid);

                    if (user) {
                       //document.write(uid);
                    }

                    else {
                       location.href = "login.php";
                    }
                });
            }

            //check_user();

            function sign_out(){
                firebase.auth().signOut().then(function() {
                  console.log('Signed Out');
                    location.href = "login.php";
                }, function(error) {
                  console.error('Sign Out Error', error);
                });
            }

        </script>
    </head>
    <body>
        <div id="note"><div class="card" style="width: 100%; color: red; background: white; height: 10px; opacity: 1; box-shadow: none; position: fixed; margin-bottom: 10px; z-index: 3;"><center style="position: relative; bottom: 5px; font-weight: 900; font-family: Open Sans;"><b>NOTE: Please download the iOS and Android app avaliable on the iOS app store and Google Play store to access more Vantage features. </b> <a onclick="note();" style="color: black; text-align: right;">Dismiss</a></center>
        </div><br>
        </div>
            <div class="card-side" style="position: fixed; z-index: 2; height: 100%; width: 20%; background: #212121;">
                <div style="color: white; padding-top: 10px; padding-bottom: 10px;">
                    <center>
                        <a href="#" class="title" style="color: white; font-size: 35px;">Vantage</a><br><br>
                        <a href="index.php">Your Questions</a><br><br>
                        <a onclick="ask();">Ask Question</a><br><br>
                        <a href="subjects.php" id="sub">View Questions</a><br><br>
                        <a onclick="sign_out();">Sign Out</a>
                    </center>
                </div>
            </div><br>
        <!--<div class="header">
            <ul>
                <li style=""><p style="position: absolute;">Sidebar<p><div class="title"><a onclick="toggle();" style="text-decoration: none; color: white;">Vantage</a> &nbsp;<input type="text" placeholder="Answer Question" class="search" style="position: relative; bottom: 2px;" onclick="change_search()" id="q"></div></li>
            </ul>
        </div>-->
        <!--<center>
            <div class="title" style="padding-top: 5px;"><a onclick="toggle();" style="text-decoration: none; color: white;">Vantage</a> &nbsp;<input type="text" placeholder="Answer Question" class="search" style="position: relative; bottom: 2px;" onclick="change_search()" id="q"></div>
        </center>-->
