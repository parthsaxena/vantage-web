<?php

include '../sessions/user.php';
include '../header.php';
include 'feed_query.php';
include '../profile/query.php';
 
?>
    <title>Pinder | Feed</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script src="https://cdn.socket.io/socket.io-1.4.5.js"></script>
    <!--<script src="/pinder/js/typeahead.min.js"></script>-->
    <script>
        $(document).ready(function() {
            $("#compose").click(function() {
                $("#panel").slideToggle("slow");
            });
            
            $("#panel").slideToggle("slow");
            
            $("#searchbar").typeahead({
                name: 'typeahead',
                remote:'search_suggestions.php?key=%QUERY',
                limit : 00
            });
            
            $("#subject").typeahead({
               name: 'subject',
                remote: 'subject_suggestions.php?key=%QUERY',
                limit: 20
            });
        });
    </script>
<center>
    <style>
        
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

.button {
  font-size: 1em;
  padding: 10px;
  color: #fff;
  border: 2px solid orange;
  border-radius: 20px/50px;
  text-decoration: none;
  cursor: pointer;
  transition: all 0.3s ease-out;
}
.button:hover {
  background: orange;
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
  width: 70%;
  height: 100%;
  position: relative;
  transition: all 5s ease-in-out;
}

.popup h2 {
  margin-top: 0;
  color: #333;
  font-family: Tahoma, Arial, sans-serif;
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
}
.popup .close:hover {
  color: orange;
}
.popup .content {
  max-height: 30%;
  overflow: auto;
}
        
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
            width: 70%;
            margin-left: 3%;
            background-color: #E9E7E7;
            border-radius: 5px;
            position: relative;
            bottom: 60px;
            background: rgb(200, 200, 200);
            background: rgba(200, 200, 200, 0.7);
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
            outline: medium none;
            padding: 8px 12px;
            width: 396px;
            position: fixed;
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
            position: fixed;
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
        
        .searchbox {
            border: 2px solid #CCCCCC;
            border-radius: 8px;
            font-size: 20px;
            height: 50px;
            line-height: 50px;
            outline: medium none;
            padding: 8px 12px;
            width: 396px;
        }
    
        .title { 
            position: relative;
            right: 12%; 
            font-size: 20px;
        }
        
        .top {
            position: relative;
            bottom: 90px;
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
        
        .input_text {
            border: none; width: 75%; border-radius: 5px; height: 40px; padding-left: 15px;
        }
    </style>

    <!-- Page Content -->

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js">        </script>
     <script src="/pinder/js/typeahead.min.js"></script>

    <script>
        function search() {
            var username = document.getElementById("searchbar").value;
            var url = "http://scapter.org/pinder/profile?u=" + username;
            window.location.replace(url);
        }
    </script>
    
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <center>
                        <div class="top">
                            <!--<div id="user_message">
                                <div class="user_message">
                                    Click the pannel with your username below to post something <button class="message_text" onclick="dismiss();">Dismiss</button>
                                </div>
                            </div>-->
                            <img style="position: relative; top: 15px;" src="../images/logo.png" height="50">
                            &nbsp;&nbsp;
                            <input style="" autocomplete="on" spellcheck="false" class="" name="typeahead" id="searchbar" type="text" placeholder="Search For A User...">
                            <!--<button type="submit" onclick="search()">Search</button>-->
    
                        </div>
                        <div id="submit_post_div">
                            <br>
                            <div id="compose">
                                <img class="img-circle" src="<?php echo $profile_picture; ?>" height="65" width="65">
                                <p style="display: inline-block; font-size: 20px;">
                                    <?php echo '&nbsp;'.$user?>
                                </p> 
                            </div>
                            <br>
                                <form action="submit_post.php" method="POST" required>
                                    <input style="border: none; width: 75%; border-radius: 5px; height: 40px; padding-left: 15px;" type="text" name='title' placeholder='Title your post...' required>
                                    <br>
                                    <br>
                                    <textarea style="box-sizing: border-box; padding-left: 15px; padding-top: 5px; border: none; border-radius:5px; border-top: 1px solid #E9E7E7; width: 75%; margin-left: 2px;" name='content' id="post_content" rows="7" placeholder="Ask a question or write something interesting..." required></textarea>
                                    <br>
                                    <a onclick="image();" id="image">
                                    <img src="https://repo.spydar007.com/packages/images/Screenshot.png" height="25" width="25" style="position: relative; bottom: 35px; left: 34%;">
                                    </a>
                                    <!--<input id="subject" style="border: none; width: 50%; border-radius: 5px; padding-left: 15px; height: 40px;" type="text" name="class" placeholder='Subject or Class (Optional)'>-->
                                    
                                    <div id="upload"></div>
                                    
                                    <input style="" id="subject" autocomplete="off" spellcheck="false" name="class" id="searchbar" type="text" placeholder="Subject or Class (Optional)" required>
                                    <!--<br>
                                    <br>-->
                                <br><br>
                                    <button style="height: 50px; position: relative; border: none;" type="submit" class="btn btn-success"><span class="glyphicon glyphicon-send"></span>  Send</button>
                                <button style="height: 50px; position: relative; border: none;" type="reset" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>  Discard</button>
                                <script>
                                        function image() {
                                            var image = document.getElementById("image").value;
                                            
                                            document.getElementById("upload").innerHTML = 
                                            "<input style='height: 45px; width: 300px; border-radius: 5px; padding-left: 5px; border: none; position: relative; bottom: 10px;' type='text' name='image' placeholder='Paste url for image'><br>";
                                        }
                                    </script>
                                </form>
                                <br>
                                <br>

                            </div>

                        </div>
                    </center>
                    <br>
                    <br>


                <div id="refresh">
                  <?php
 
                                    while ($row = $query->fetch_array()) {
                                        $posted_by = $row['posted_by'];
                                        $title = $row['title'];
                                        $content = $row['content'];
                                        $class = $row['class'];
                                        $id = $row['id'];
                                        $image = $row['image'];
                                                     
                                        $checkUser = false;
                                        
                                        $currentUsername = $_SESSION["user"];
                                        $findUpvotesQuery = mysqli_query($conn, "SELECT * FROM posts_votes WHERE post_id='$id'");
                                        $UPVOTES = 0;
                                        while ($upvoteRow = $findUpvotesQuery->fetch_array()) {
                                            $UPVOTES++;
                                            if ($upvoteRow['voted_from'] == $currentUsername) {
                                                // Current user has already upvoted post
                                                $checkUser = true;
                                            } else {
                                                // Current user has not upvoted post
                                                $checkUser = false;
                                            }
                                        }
                                        
                                        $profile_picture_query = mysqli_query($conn, "SELECT profile_picture FROM users WHERE username='$posted_by' ");
                                        $pp_result = mysqli_fetch_assoc($profile_picture_query);
                                        $profile_picture = $pp_result['profile_picture'];
                                            
                                        echo "<center><div id='post_div'>
														<h4 style='margin-left: 20px;'><a style='float: left;' href='/pinder/profile?u=$posted_by'><img src='$profile_picture' height='50' width='50' class='img-circle'> $posted_by</a></h4>
                                                        <br>
														<center><h3><a class='title' href='post.php?id=$id'>$title</a></h3></center><br>

														<center><p>$content</p><br></center>";
                                        
                                        if ($image != ""){
                                            echo "<img src='$image' height='300'><br>";
                                        }
                                        
                                        echo "<br>
                                        <center><p font-size='14'>&#128218; $class</p></center>";
                                        if ($checkUser) {    
                                            // User has already upvoted post
                                            echo "<p>
                                                <br>
                                                <form action='' method='POST'>
                                                <button title='You are a big bafoon farto quoe. You can only upvote a post once you big bafoon.' id='up_$id' class='btn btn-success btn-mean' align='right' name='up_".$id."' type='sumbit'>
                                    <span class='glyphicon glyphicon-thumbs-up'></span>&nbsp;&nbsp;&nbsp;$UPVOTES</button>
                                    </form>
                                    <div align='right' style='position: relative; right: 15px;'><a href='post.php?id=$id'><span class='glyphicon glyphicon-comment'></span>&nbsp;Comment</a></div>
                                </p>
				                </div><br><br><br><br><center>";
                                        }
                                        
                                        else {
                                            // User has NOT upvoted post
                                            echo "<p>
                                                <br>
                                                <form action='test.php?id=$id' method='POST'>
                                                <button class='btn btn-success btn-cool' align='right' name='up_".$id."' type='sumbit'>
                                    <span class='glyphicon glyphicon-thumbs-up'></span>&nbsp;&nbsp;&nbsp;$UPVOTES</button>
                                </form>
                                <div align='right' style='position: relative; right: 15px;'><a href='post.php?id=$id'><span class='glyphicon glyphicon-comment'></span>&nbsp;Comment</a></div>
                                </p>
				                </div><br><br><br><br><center>
                                ";
                                            if (isset($_POST["up_".$id])){
                                                /*$up = 'up';
                                                $down = 'down';
                                                $up_query = mysqli_query($conn, "INSERT INTO posts_votes (voted_from, post_id, up_or_down) VALUES ('$user', '$id', '$up')");
                                                if (!$up_query) {
                                                    echo mysqli_error($conn);
                                                }
                                                $get_post_query = mysqli_query($conn, "SELECT users_ups FROM posts WHERE id ='$id' ");
                                                if (!$get_post_query){
                                                    echo mysqli_error($conn);
                                                }
                                                $get_post = mysqli_fetch_assoc($get_post_query);
                                                $users_uped = $get_post["users_ups"];
                                                $user_id = hash('ripemd160', $user);
                                                $users_ups = ",".$user_id.",".$users_uped;
                                                $users_ups_query = mysqli_query($conn, "UPDATE posts SET users_ups ='$users_ups' WHERE id='$id' ");
                                                if (!$users_ups_query) {
                                                    echo mysqli_error($conn);
                                                }*/
                                                
                                                include "voteUp_action.php";
                                                
                                            }
                                        }
                                        
                            
                                    }
                                ?>
                    </div>
                    <script>
                        
                        var socket = io.connect("http://scapter.org:3000");
                        
                        socket.on('update messages', function() {
                            console.log("Recieived update request from server...");
                            //$("#refresh").load(location.href+" #refresh>*","");
                            $("#refresh").load(location.href);
                            var div = document.getElementById('refresh');
                            div.scrollTop = div.scrollHeight;
                        });
                        
                        function dismiss() {
                            document.getElementById("user_message").innerHTML = "";
                        }
                        
                        
                    </script>
                    </center>
                </div>
            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery (Add js files when needed) -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Menu Toggle Script -->
    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>

    </body>

    </html>
