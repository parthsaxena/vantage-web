<?php

	$conn =	mysqli_connect("scapter.org", "root", "rroot451", "pinder");
	if (!$conn) {
		 echo "Unable to establish connection to database. " . mysqli_connect_errno();
		 exit;
	}

	//echo "Connection Established.";

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <!--<title>Simple Sidebar - Start Bootstrap Template</title>-->

    <!-- Bootstrap Core CSS -->
    <link href="/vantage/css/bootstrap.min.css" rel="stylesheet">
		<link href="/vantage/css/bootstrap.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/vantage/css/simple-sidebar.css" rel="stylesheet">
    <script src="https://cdn.socket.io/socket.io-1.4.5.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script>
        setInterval(function() {
            $("#chats").load(location.href+" #chats>*","");
        }, 10000);
    </script>
    
    <style>

		#sidebar-wrapper { 
			opacity:0.7;
		}

    .night{
        	position: fixed;
        	top: -20px;
        	left: -20px;
        	right: -40px;
        	bottom: -40px;
        	width: auto;
        	height: auto;
        	background-image: url(http://www.siwallpaperhd.com/wp-content/uploads/2015/09/night_sky_wallpaper_full_hd.jpg);
            -webkit-filter: blur(5px);
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
        	background-image: url(http://vantage.social/vantage/images/bg/day/day-2.jpeg);
        	background-size: cover;
        	-webkit-filter: blur(5px);
        	z-index: 0;
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


</head>

<body>

    <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <br>
                <li class="sidebar-brand">
                    <?php 
                    
                    $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$user' ");
                    $result = mysqli_fetch_assoc($query);
                    $user_picture = $result["profile_picture"];
                    
                    ?>
                    <a style="color: white;" href="/vantage/profile">
                        <img class="img-circle" src="<?php echo $user_picture; ?>" height="60" width="60"> Your Profile
                    </a>
                </li>
                <li>
                    <a href="/vantage">Feed</a>
                </li>
								<li>
										<?php
										$user_int_query = mysqli_query($conn, "SELECT id FROM users WHERE username = '$user' ");
										$user_int_result = mysqli_fetch_assoc($user_int_query);
										$user_int = $user_int_result['id'];

										$result = mysqli_query($conn, "SELECT * FROM comments WHERE user_sent_to = '$user_int' AND
										read_y_n = '' AND posted_by NOT LIKE '%$user%' ");

										$new_activity = mysqli_num_rows($result);
										?>
										<a href="/vantage/activity">Notifications (<?php echo $new_activity; ?>)</a>
								</li>
								<li>
								    <a href="/vantage/logout">Log Out</a>
								</li>
                                <br>
                                <li><div style="color: white;">Your Chats</div></li>
                                <div id="chats">
                                <?php 
                                
                                $user_with_comma = ", ".$user;
                                $user_2 = ",".$user.",";
                                $user_3 = ", ".$user.",";
                
                                $gSessions_query = mysqli_query($conn, "SELECT * FROM chat_sessions WHERE people LIKE '%$user_with_comma' OR people LIKE '%$user_2%' OR people LIKE '%$user_3%' ORDER BY date DESC");
                            
                            if (!$gSessions_query) {
                                echo mysqli_error($conn);
                            }
                            
                            while ($row = $gSessions_query->fetch_array()) {
                                $people_string = $row["people"];
                                $session_id = $row["session_id"];
                                $people = str_replace($user_with_comma, "", $people_string);
                                $people1 = str_replace($user_2, "", $people);
                                $people2 = str_replace($user_3, "", $people1);
                                $people_i = str_replace(" ", "", $people2);
                                $people_d = explode(",", $people_i);
                                $type = $row["type"];
                                
                                
                                $recent_message_query = mysqli_query($conn, "SELECT * FROM chat_messages WHERE session_id = '$session_id' ORDER BY id DESC LIMIT 1");
                                $rm_result = mysqli_fetch_assoc($recent_message_query);
                                $recent_message = $rm_result['content'];
                                $posted_by = $rm_result['posted_by'];
                                $date = $rm_result['date'];
                                
                                $url = '/vantage/chat/?id='.$session_id.'#contact';
                                
                                $length = count($people_d);
                                
                                $people_f = "";
                                
                                for ($i = 0; $i < $length; $i++) {
                                    $people_f = $people_d[$i];
                                }
                                
                                $profile_picture_query = mysqli_query($conn, "SELECT profile_picture FROM users WHERE username='$people_f' ");
                                $pp_result = mysqli_fetch_assoc($profile_picture_query);
                                $profile_picture = $pp_result['profile_picture'];
                                
                                if ($type == "group"){
                                    echo "<li><a href='$url' ><img class='img-circle' src='https://cdn3.iconfinder.com/data/icons/pix-glyph-set/50/520643-group-512.png' height='50' width='50' target='popup'> "; 
                                    for ($i = 0; $i < $length; $i++) {
                                        $people_f = $people_d[$i];
                                        echo $people_f." ";
                                    }
                                    echo "</a></li><br>";
                                }
                                else {
                                    echo "<li><a href='$url' ><img class='img-circle' src='$profile_picture' height='50' width='50' target='popup'> "; 
                                    for ($i = 0; $i < $length; $i++) {
                                        $people_f = $people_d[$i];
                                        echo $people_f;
                                    }
                                    echo "</a></li><br>";
                                }
                                
                            
                            }                
                
                                ?>
                            </div>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->
        
        <script>
            function popitup(url) {
	           newwindow=window.open(url,'name','height=200,width=150');
	           if (window.focus) {newwindow.focus()}
	           return false;
            }
            
             var socket = io.connect("http://scapter.org:3000");
             
             socket.on('update messages', function() {
                console.log("Recieived update request from server...");
                $("#refresh").load(location.href+" #refresh>*","");
                window.location.replace("#");
                });
            
        </script>
				<style>

				</style>
