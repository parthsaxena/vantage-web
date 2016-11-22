<?php include "../header2.php"; ?>
<!DOCTYPE html>
<html>
    
    <head>
        <title>Vantage | Feed</title>
        
        <link rel="stylesheet" type="text/css" href="css/header.css">
        
          <script src="https://www.gstatic.com/firebasejs/3.1.0/firebase-app.js"></script>
  <script src="https://www.gstatic.com/firebasejs/3.1.0/firebase-auth.js"></script>
  <script src="https://www.gstatic.com/firebasejs/3.1.0/firebase-database.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        
    </head>
    
    <body>
        
        <center style="position: relative; top: 100px; font-family: Roboto;"> 
        <input type="text" id="post_content" placeholder="Write post" style="position: relative; top: 50px;">  
            <button onclick="save_post()">Post</button>    
        <div id="posts"></div>
        </center>
        
    </body>
    <script src="main.js"></script>
</html>