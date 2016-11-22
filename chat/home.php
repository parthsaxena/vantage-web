<?php
    include '../sessions/user.php';
    include '../header.php';
    include 'feed_query.php';
    include '../profile/query.php';
?>
<div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <center style="position: relative; bottom: 100px;">
                        <style>
        #submit_post_div {
            height: 25%;
            width: 70%;
            margin-left: 3%;
            background-color: #E9E7E7;
            border-radius: 5px;
            position: relative;
            bottom: 60px;
            background: rgb(200, 200, 200);
            background: rgba(200, 200, 200, 0.5);
        }

        #post_div {
            overflow: auto;
            width: 500px;
            height: 150px;
            margin-left: 3%;
            background-color: #E9E7E7;
            border-radius: 5px;
            position: relative;
            bottom: 0px;
            background: rgb(200, 200, 200);
            background: rgba(200, 200, 200, 0.7);
            font-size: 25px;
        }

        #profile_post_link {
            margin-right: 85%;
            font-size: 15px;
        }

        .btn-mean {
            /*border: 1px solid #FFF;*/
            border: none;
            color: #FFF;
        }
        
        .btn-cool {
            /*border: 1px solid #5cb85c;*/
            border: none;
            color: #5cb85c;
            background: #FFF;
        }

        .typeahead, .tt-query {
            border: 2px solid #CCCCCC;
            border-radius: 8px;
            font-size: 20px;
            height: 50px;
            line-height: 50px;
            outline: medium none;
            padding: 8px 12px;
            width: 396px;
        } 
        .input_search {
            background-color: #FFFFFF;
            height: 20%;
            border: none;
        }
        .typeahead:focus {
            border: 2px solid #0097CF;
        }
        .tt-hint {
            color: #999999;
            border: 2px solid #CCCCCC;
            border-radius: 8px;
            font-size: 20px;
            height: 50px;
            line-height: 50px;
            outline: medium none;
            padding: 8px 12px;
            width: 396px;
            position: relative;
            bottom: 10px;
        }
        .move_top {
            bottom: 10px;
        }
        .tt-dropdown-menu {
            background-color: #FFFFFF;
            border: 1px solid rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
            margin-top: 12px;
            padding: 8px 0;
            width: 422px;
        }
        .tt-suggestion {
            font-size: 24px;
            line-height: 24px;
            padding: 3px 20px;
        }
        .tt-suggestion.tt-is-under-cursor {
            background-color: #0097CF;
            color: #FFFFFF;
        }
        .tt-suggestion p {
            margin: 0;
        }
        
        #panel {
            display: none;
        }

        p {
            opacity: 1;
        }

      .vote_buttons {
        background: none;
        border: none;
      }
    
        .title { 
            margin-right: 175px;
        }
        
        .top {
            top: -90px;
            position: relative;
            left: 30px;
        }
        
        .user_message {
            /*background-color: #B2EBF2;*/
            height: 30px;
            width: 60%;
            opacity: 0.5px;
            position: relative;
        }
        
        .message_text {
            background: none;
        border: none;
        display: inline;
        font: inherit;
        margin: 0;
        padding: 0;
        outline: none;
        outline-offset: 0;
        color: blue;
        cursor: pointer;
        text-decoration: underline;
        }
                            
        .profile_picture {
            position: relative;
            right: 180px;
            top: 30px;
            
        }
                            
        .left {
            position: relative;
            right: -135px;
            bottom: 100px;
        }
                            
        .left_rm {
            position: relative;
            right: 35px;
            bottom: 60px;
        }
    </style>
                        <form action="" method="POST">
                            <input id="searchbar" type="text" name="user_chat" placeholder="Look for people to chat with...">
                            <button type="submit" name="submit_user_chat">Create Conversation</button>
                        </form>
                        <br>
                        <?php 
                        if (isset($_POST["submit_user_chat"])){
                            
                             $user_chat = $_POST["user_chat"];
                            
                             $exists_query = mysqli_query($conn, "SELECT * FROM chat_sessions WHERE people LIKE '%$user_chat%' OR people LIKE '$user' ");
                            
                            if(!$exists_query){
                                echo mysqli_error($conn);
                            }
                            
                             $exists = mysqli_num_rows($exists_query);
                            
                             if ($exists > 0){
                                 echo "<div style='color: red'>You already have a chat with ".$user_chat."</div><br>";
                             }
                            
                            else {
                            
                             $user_session_query = mysqli_query($conn, "SELECT * FROM users WHERE username ='$user_chat'");
                             if (!$user_session_query){
                                 echo mysqli_error($conn);
                             }
                             $us_result = mysqli_fetch_assoc($user_session_query);
                             $user_id = $us_result['user_id'];
                            
                             echo $user_id;
                            
                             /*$user_hash = hash('ripemd160', $_SESSION['user']);
                                                                
                             $id_combo_array = array($user_id, $user_hash);
                             sort($id_combo_array);
                                                                
                             $length = count($id_combo_array);
                                                                
                             $combo = "";
                                                                
                             for($x = 0; $x<$length; $x++){
                                $combo = $id_combo_array[$x];
                             }*/
                            
                            $number = rand(-500, 500);
                            $pre_combo = $number."a".$user_chat."b".$user;
                            
                            $combo = hash('ripemd160', $pre_combo);
                            
                            //echo $combo;
                            
                            $type = "normal";
                            $push_users = ",".$user.",".$user_chat.",";
                            
                            $users_chat_query = mysqli_query($conn, "INSERT INTO chat_sessions (created_by, session_id, type, people) VALUES ('$user', '$combo', '$type', '$push_users') ");
                            
                            if (!$users_chat_query){
                                echo mysqli_error($conn);
                            }
                            }
                            
                        }
                        $user_with_comma = ",".$user.",";
                            
                            $gSessions_query = mysqli_query($conn, "SELECT * FROM chat_sessions WHERE people LIKE '%$user_with_comma%'  ORDER BY id DESC");
                            
                            if (!$gSessions_query) {
                                echo mysqli_error($conn);
                            }
                            
                            while ($row = $gSessions_query->fetch_array()) {
                                $people_string = $row["people"];
                                $session_id = $row["session_id"];
                                $people = str_replace($user_with_comma, "", $people_string);
                                $people_i = str_replace(",", "", $people);
                                
                                
                                $profile_picture_query = mysqli_query($conn, "SELECT profile_picture FROM users WHERE username='$people_i' ");
                                $pp_result = mysqli_fetch_assoc($profile_picture_query);
                                $profile_picture = $pp_result['profile_picture'];
                                
                                $recent_message_query = mysqli_query($conn, "SELECT * FROM chat_messages WHERE session_id = '$session_id' ORDER BY id DESC LIMIT 1");
                                $rm_result = mysqli_fetch_assoc($recent_message_query);
                                $recent_message = $rm_result['content'];
                                $posted_by = $rm_result['posted_by'];
                                $date = $rm_result['date'];
                                
                                echo "<br><div id='post_div' style='padding-top: 10px; padding-bottom: 10px;'><div style='position: relative; bottom: 25px;'><a class='profile_picture' href='/pinder/chat/?id=$session_id#contact'><img class='img-circle' src='$profile_picture' height='120' width='120'> <div class='left'>$people_i</div> </a><div class='left_rm' style='font-size: 17px;'>$date</div></div></div><br>";
                                
                            
                            }
                        
                        /*$users = array(
                            "anshulpanda" =>
                            array(
                            "username" => "anshulpanda"),
                            "parthsaxena" =>
                            array(
                            "username" => "parthsaxena"),
                            "arnavgarg" =>
                            array(
                            "username" => "arnavgarg")
                        );
                                
                                foreach ($users as $v) {
                                    $username = $v["username"];
                                    $username1 = str_replace($user, "", $username);
                                    echo $username1.",";
                                }*/
                        
                        ?>
                    </center>
                    </div>
                </div>
            </div>
    </div>