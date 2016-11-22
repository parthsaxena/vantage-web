<?php
include "../conn.php";
include "../sessions/user.php";
include "header.php";

//echo $user;

$chat_id = $_GET["id"];

$actual_date = date("Y-m-d h:i:sa");
$date = strtotime($actual_date);
$date_query = mysqli_query($conn, "UPDATE chat_sessions SET date ='$date' WHERE session_id ='$chat_id' ");
?>

<html>

    <head>
        <title>Vantage | Chat</title>
    </head>

    <body>
      <style>
      @import url(http://fonts.googleapis.com/css?family=Roboto);

      * {
        font-family: 'Roboto', sans-serif;
      }
        #message_box{
          position: fixed;
          bottom: 0;
          padding-top: 10px;
          width: 100%;
          left: 2%;
          /*background-color: #FFF;*/
        }
        #message_field {
          width: 90%;
          height: 40px;
          padding-left: 10px;
          background: rgb(200, 200, 200);
          background: rgba(200, 200, 200, 0.3);
          border: none;
        }
        
          #message_field:active {
            background-color: 
          }

        #color {
          margin: 0px 5px;
	        background-color: #009688;
            min-width: 10px;
	        max-width: calc(45% - 20px);
	        color: #fff;
	        padding: 5px;
	        font-size: 14px;
	        border-radius: 10px;
          position: relative;
          right: -55%;
        }
        #gray {
           margin: 0px 5px;
	        background-color: #4DB6AC;
	        max-width: calc(45% - 20px);
	        color: #fff;
	        padding: 5px;
	        font-size: 14px;
	        border-radius: 10px;
          position: relative;
          left: 25px;
          top: 5px;
        height: auto;
        /*display: inline-block;*/
        }
        #sent_by {
          color: #8C8C8C;
	        font-size: 12px;
	        margin: 4px 0px 0px 10px;
	        position: relative;
	        top: 35px;
        }
        .night{
        	position: fixed;
        	top: -20px;
        	left: -20px;
        	right: -40px;
        	bottom: -40px;
        	width: auto;
        	height: auto;
        	/*background-image: url(http://supreme-management.com/wp-content/uploads/2014/07/green-1280.png);
            http://scapter.org/pinder/images/bg/night/night-2.jpeg*/
        	background-size: cover;
        	z-index: 0;
        }

        .day{
        	position: fixed;
        	top: -20px;
        	left: -20px;
        	right: -40px;
        	bottom: -40px;
        	width: auto;
        	height: auto;
        	/*background-image: url(http://supreme-management.com/wp-content/uploads/2014/07/green-1280.png);
            http://scapter.org/pinder/images/bg/day/day-2.jpeg*/
        	background-size: cover;
        	-webkit-filter: blur(5px);
        	z-index: 0;
        }
          
          .arr {
              width: 0;
		      height: 0;
		      border-left: 8px solid transparent;
		      border-right: 8px solid transparent;
		      border-bottom: 8px solid #f1f0f0;
		      transform: rotate(315deg);
		      margin: -12px 0px 0px 45px;
          }
          
          .msg-container {
		width: 100%;
		height: 100%;
	}
	.msg-area {
		height: calc(100% - 102px);
		width: 100%;
		background-color:#FFF;
		overflow-y: scroll;
	}
	.msginput {
		padding: 5px;
		margin: 10px;
		font-size: 14px;
		width: calc(100% - 20px);
		outline: none;
	}
	.bottom {
		width: 100%;
		height: 50px;
		position: fixed;
		bottom: 0px;
		border-top: 1px solid #CCC;
		background-color: #EBEBEB;
	}
	#whitebg {
		width: 100%;
		height: 100%;
		background-color: #FFF;
		overflow-y: scroll;
		opacity: 0.6;
		display: none;
		position: absolute;
		top: 0px;
		z-index: 1000;
	}
	#loginbox {
		width: 600px;
		height: 350px;
		border: 1px solid #CCC;
		background-color: #FFF;
		position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
		z-index: 1001;
		display: none;
	}
	h1 {
		padding: 0px;
		margin: 20px 0px 0px 0px;
		text-align: center;
		font-weight: normal;
	}
	button {
		background-color: #43ACEC;
		border: none;
		color: #FFF;
		font-size: 16px;
		margin: 0px auto;
		width: 150px;
	}
	.buttonp {
		width: 150px;
		margin: 0px auto;
	}
	.msg {
		margin: 10px 10px;
		background-color: #f1f0f0;
		max-width: calc(45% - 20px);
		color: #000;
		padding: 10px;
		font-size: 14px;
        border-radius: 5px;
	}
	.msgfrom {
		background-color: #0084ff;
		color: #FFF;
		margin: 10px 10px 10px 55%;
        border-radius: 5px;
	}
	.msgarr {
		width: 0;
		height: 0;
		border-left: 8px solid transparent;
		border-right: 8px solid transparent;
		border-bottom: 8px solid #f1f0f0;
		transform: rotate(315deg);
		margin: -12px 0px 0px 45px;
	}
	.msgarrfrom {
		border-bottom: 8px solid #0084ff;
		float: right;
		margin-right: 45px;
	}
	.msgsentby {
		color: #8C8C8C;
		font-size: 12px;
		margin: 4px 0px 0px 10px;
	}
	.msgsentbyfrom {
		float: right;
		margin-right: 12px;
	}
          
      </style>
        
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
        <div id="refresh" style="position: relative; top: 100px;">

            <!-- Messages -->

            <?php
                $get_messages_query = mysqli_query($conn, "SELECT * FROM chat_messages WHERE session_id='$chat_id' ORDER BY id");

                while($row = $get_messages_query->fetch_array()) {
                    $posted_by = mysqli_escape_string($conn, $row["posted_by"]);
                    $content1 = mysqli_escape_string($conn, $row["content"]);
                    $date = $row["date"];
                    $image = $row["image"];
                    
                    $num_rows = mysqli_num_rows($get_messages_query);
                    $counter = 0;
                    
                    $content = str_replace("\\", "", $content1);

                    if ($posted_by == $user){
                        
                        if ($image != ""){
                            echo "<div align=right><a href='$image' download><img style='border-radius: 5px; position: relative; right: 10px; max-height: 500px;' src='$image'></a></div> <br>";
                        }
                        
                        else {
                            /*echo "
                          <div align=right id=color>$content<br>";
                        echo "<br><div id=sent_by>&nbsp;</div></div><br>";*/
                        echo "<div class=\"msgc\" style=\"margin-bottom: 30px;\"> <div class=\"msg msgfrom\">".$content."</div> <div class=\"msgarr msgarrfrom\"></div> <div class=\"msgsentby msgsentbyfrom\" style='position: relative; right: 30px;'>You</div> </div><br>";
                        }
                    }
                    else {
                    
                      $query = mysqli_query($conn, "SELECT * FROM users WHERE username = '$posted_by' ");
                      $result = mysqli_fetch_assoc($query);
                      $profile_picture = $result["profile_picture"];    
                      
                      if ($counter++ == $num_rows){
                      echo "
                          <br><div id='gray'>$content<div id=sent_by>&nbsp;$posted_by on $date</div></div>
                      <br><br>";
                      }
                      else {
                         echo "&nbsp;<img class='img-circle' src='$profile_picture' height='40'>";
                          if ($image != ""){
                              echo "<br><div><a href='$image' download><img style='border-radius: 5px; position: relative; left: 20px; top: 10px; max-height: 500px;' src='$image'></a></div> <br>";
                          }  
                            
                        /*echo "<div id=sent_by>&nbsp;<a style='color: #8C8C8C;' href='../profile/?u=$posted_by'>$posted_by</a></div></div>
                      <br><br>";*/
                          
                    else {
                       echo "<div class=\"msgc\"> <div class=\"msg\">" .$content. "</div> <div class=\"msgarr\"></div> <div class=\"msgsentby\">" .$posted_by. "</div> </div><br>";
                    }
                      }
                    }

                }
            ?>

      </div>
      <br><br><br><br><br><br>
        <?php 
            /*$u_message = $_POST["message"];
            $message = mysqli_real_escape_string($conn, $u_message);
            echo $message;*/
        
            function recent_date(){
                $date = date('l, g:i A');
                $date_query = mysqli_query($conn, "UPDATE chat_session SET date ='$date' WHERE session_id ='$chat_id' ");
            }
        ?>
        <script>
            
            function mysqlEscape(stringToEscape){
                return stringToEscape
                    .replace("'", "&#39");
                }

            var socket = io.connect("http://scapter.org:3000");

            function sendMessage() {
                
                var u_message = document.getElementById("message_field").value;
                var message = mysqlEscape(u_message);
                var sendTo = "parthsaxena";
                var chatID = "<?php echo $chat_id; ?>";
                var currentUsername = "<?php echo $user; ?>";
                var date = "<?php echo date('l, g:i A'); ?>";
                    
                    console.log(date);
                
                var data = {
                    date: date,
                    message: message,
                    sendTo: sendTo,
                    chatID: chatID,
                    sentFrom: currentUsername
                };

                console.log("Sending message...");
                socket.emit("new message", data);
                
                document.getElementById("message_field").value = "";
                
                var aSound = document.createElement('audio');
                aSound.setAttribute('src', 'ding.mp3');
                aSound.play();
                
                
                
            }

            socket.on('update messages', function() {
                console.log("Recieived update request from server...");
                $("#refresh").load(location.href+" #refresh>*","");
                var id = "<?php echo $chat_id; ?>";
                window.location.replace("index.php?id="+id+"#contact");
                });

        </script>
        <center>
            <br>
            <div id="contact" style="height: 300px;"></div>
        <div id="message_box">
        <form action="" method="POST">
          <input name="message" type="text" id="message_field" placeholder="Send A Message..." autofocus autocomplete="off">
          <button style="visibility: hidden; background-color: #99CCFF; border: none; height: 1px; width: 1px; position: relative; right: 54px;" onclick="sendMessage()">Send</button><br><br>
            </form>
            
            <?php 
            ?>
        </div>
      </center>
         <!-- jQuery -->
    <script src="../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>

    <!-- Scrolling Nav JavaScript -->
    <script src="../js/jquery.easing.min.js"></script>
    <script src="../js/scrolling-nav.js"></script>
    </body>

</html>
