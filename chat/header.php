<?php
$session_id = $_GET["id"];

$user_with_comma = ", ".$user;
$user_2 = ",".$user.",";
$user_3 = ", ".$user.",";

$query = mysqli_query($conn, "SELECT * FROM chat_sessions WHERE session_id = '$session_id'");
$result = mysqli_fetch_assoc($query);
$people_string = $result["people"];
$type = $result["type"];

$people = str_replace($user_with_comma, "", $people_string);
$people1 = str_replace($user_2, "", $people);
$people2 = str_replace($user_3, "", $people1);
$people_i = str_replace(" ", "", $people2);
$people_c = str_replace(",", "", $people_i);
$people_d = explode(",", $people_i);

//echo $people_d;

//ppo = profile picture of other user
$ppo_query = mysqli_query($conn, "SELECT * FROM users WHERE username = '$people_c' ");
$ppo_result = mysqli_fetch_assoc($ppo_query);
$pp_other = $ppo_result["profile_picture"];
?>
<html>
    <head>
        <script src="https://cdn.socket.io/socket.io-1.4.5.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        
        <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS 
    <link href="http://blackrockdigital.github.io/startbootstrap-scrolling-nav/css/scrolling-nav.css" rel="stylesheet">
    --></head>
    <body>
        <center>
            <div class="header"><center>
                <a style="float: left; position: relative; left: 10px; font-size: 15px; color: black;" onclick='window.history.back();'><span height="100" class="glyphicon glyphicon-menu-left"></span> Back</a>
                <?php
                
                
                
                 $length = count($people_d);
                                
                $people_f = "";
                    
                if ($type == "group"){
                    echo "<img class='img-circle' src='https://cdn3.iconfinder.com/data/icons/pix-glyph-set/50/520643-group-512.png' height='50' width='50'>";
                }
                
                if ($type == "normal"){
                    echo "<img class='img-circle' src='$pp_other' height='50' width='50'>&nbsp;";
                }
                    
                for ($i = 0; $i < $length; $i++) {
                    $people_f = $people_d[$i];
                        echo $people_f." ";
                }
                ?>
                <a href="#settings" style="float: right; position: relative; right: 15px; font-size: 15px; color: black;" onclick=''><span height="100" class="glyphicon glyphicon-wrench"></span> Settings</a>
                </center></div>
            <div id='settings' class='overlay' style="z-index: 5;">
       <div style='width: 50%; position: relative; color: transparent;'>
		<a style='float: right; position: relative; left: 45%;' onclick='window.history.back();'>Close</a>
		<div class='content' style='border: 2px; border-color: white; border-radius: 5px;'>
			<form style="position: relative; top: 250px;" action="add1.php" method="POST">
                <input style="color: black;" type="person" placeholder="Add someone...">
                <button type="submit">Add</button>
            </form>
		</div>
        </div>
</div>
        <style>
           .brand { margin-left: auto; margin-right: auto; }
            
           .header {
		      width: 100%;
		      height: 70px;
		      border-bottom: 1px solid #CCC;
		      text-align: center;
		      padding: 15px 0px 5px;
		      font-size: 20px;
		      font-weight: normal;
              position: fixed;
               top: -5px;
              background-color: white;
              z-index: 3;
	}
            
            .box {
  width: 20%;
  margin: 0 auto;
  background: rgba(255,255,255,0.2);
  padding: 35px;
  border: 2px solid #fff;
  border-radius: 20px/50px;
  background-clip: padding-box;
  text-align: center;
}

.overlay {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background: rgba(0, 0, 0, 0.7);
  transition: opacity 500ms;
  visibility: hidden;
  opacity: 0;
}
.overlay:target {
  visibility: visible;
  opacity: 1;
}

.popup {
  margin: 70px auto;
  padding: 20px;
  background: #fff;
  border-radius: 5px;
  width: 30%;
  position: relative;
  transition: all 5s ease-in-out;
}

.popup h2 {
  margin-top: 0;
  color: #333;
  font-family: Roboto;
}
.popup .close {
  position: absolute;
  top: 20px;
  right: 30px;
  transition: all 200ms;
  font-size: 30px;
  font-weight: bold;
  text-decoration: none;
  color: #333;
  width: 100%;
}
.popup .close:hover {
  color: orange;
}
.popup .content {
  max-height: 30%;
  width: 100%;
}
        </style>
    </center>
    </body>
</html>