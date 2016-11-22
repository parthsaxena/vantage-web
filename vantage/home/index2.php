<?php

include '../sessions/user.php';
include '../header2.php';
include 'feed_query.php';
include '../profile/query.php';
 
?>
                <br>
                <div>
                    <br><br><br><br>
                <center>
                <form action="">
                    <br><div id="post_wrapper">
                    <table style="font-family: Roboto; float: left;">
                        <tr>
                            <td><img id="post_img" height="50" src="../images/empty_profile_picture.jpg"></td>
                            <td><?php echo $user; ?></td>
                        </tr>
                    </table><br><br><br><br><div class="submit_post" contenteditable="true" placeholder="Questions? Comments? Something cool? ..." required></div><br>
                        <table style="font-family: Roboto;">
                        <tr>
                            <td><a href="" style="text-decoration: none; color: #FFE082;"><i class="fa fa-book" aria-hidden="true" style="font-size: 1.5em;"></i></a></td>
                            <td><div contenteditable='true' placeholder='Subject'></div></td>
                        </tr>
                        </table>
                        <hr style="border-top: 1px solid #EEE;"><br>
                        <button class="post_button" style="float: left;"><i class="fa fa-image" aria-hidden="true" style="font-size: 1.5em;" type="submit"></i></button>
                        <button class="post_button" style="float: right;"><i class="fa fa-send" aria-hidden="true" style="font-size: 1.8em; color: white;"></i></button><br>
                    </div>
                </form>
                    
                    <div>
                        <div id="chatbox">
                        <iframe id="draggable" style="border: 1px solid darkgrey; border-radius: 5px; width: 350px; height: 370px;" src="http://vantage.social/vantage/home/chat.php?id=1893b834974068eb490eb0e10b7730e829c40d2c&saved_message=hi#contact">
                            <p>Your browser does not support iframes.</p>
                        </iframe>
                        </div>
                    </div>
                    
                </div>
                <br>
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
                            
                            $comments_query = mysqli_query($conn, "SELECT * FROM comments WHERE post_id = '$id' ");
                            $num_comments = mysqli_num_rows($comments_query);
                            
                            echo "<div class='post'><div  style='float: left; display: inline-block;'>
                    
                    <table style='padding-top: 5px;'>
                        <tr>
                            <td><img id='post_img' height='50' src='../images/empty_profile_picture.jpg'></td>
                            <td>Anonymous</td>
                        </tr>
                    </table>
                    
                    </div>
                    <br><br><br>
                    <hr style='border-top: 1px white; visibility: hidden;'>
                    <center style='position: relative; bottom: 15px;'>$content</center>";
                            
                    if ($image != ""){
                        echo "<a href='$image' target='_blank'><img src='$image' height='300' style='border-radius: 5px;'><br></a><br>";
                    }
                            
                    echo "<a href='' style='text-decoration: none; color: #FFE082;'><i class='fa fa-book' aria-hidden='true' style='font-size: 1.5em;'></i></a> $class
                        <hr style='border-top: 1px solid #EEE;'>";
                            
                        
                        if ($checkUser) { 
                        echo "<a href='' style='float: left; margin-left: 10px; text-decoration: none; color: #81C784'><i class='fa fa-thumbs-up' aria-hidden='true' style='font-size: 1.5em;'></i> $UPVOTES<i style='color: #81C784;' class='fa fa-check' aria-hidden='true' style='font-size: 1.5em;'></i></a>";
                        }
                            
                        else {
                            echo "<a href='' style='float: left; margin-left: 10px; text-decoration: none; color: #81C784'><i class='fa fa-thumbs-up' aria-hidden='true' style='font-size: 1.5em;'></i> $UPVOTES</a>";
                        }
                            
                            
                        echo "<a href='' style='margin-left: 10px; text-decoration: none; color: #FFAB91;'><i class='fa fa-share' aria-hidden='true' style='font-size: 1.5em;'></i></a> 
                        
                        <a href='' style='float: right; margin-right: 10px; text-decoration: none; color: skyblue;'><i class='fa fa-comment' aria-hidden='true' style='font-size: 1.5em;'></i> $num_comments</a></div><br>";
                        }
                    ?>
                    
            </center>
        </center>

        
    </body>
    
</html>

<style>
    
    body {
        @import url(http://fonts.googleapis.com/css?family=Roboto);

        * {
            font-family: 'Roboto', sans-serif;
        }
        
        background: lightgrey;
        
        overflow-x: hidden;
    }
    
    
    #chatbox {
        position: fixed;
        float: left;
        z-index: 2;
        margin-top: -12%;
    }
    
    .post {
        width: 45%; 
        min-width: 300px;
        height: auto; 
        font-family: Roboto; 
        background-color: white; 
        border-radius: 7px;
        padding-bottom: 10px;
        padding-left: 10px;
        padding-right: 10px;
    }
    
    .post_button {
        background-color: skyblue;
        border-radius: 3px;
        font-family: Roboto;
        border: none;
        height: 30px;
        color: white;
    }
    
    .icon_button {
        background-color: black;
        border-radius: 3px;
        font-family: Roboto;
        border: none;
        height: 30px;
        color: white;
    }
    
    .compose_button {
        background-color: skyblue;
        border-radius: 3px;
        font-family: Roboto;
        border: none;
        height: 30px;
        color: white;
        font-size: 15px;
    }
    
    .submit_post_bottom {
        position: relative;
        right: 26.05%;
        width: 45%;
        float: right;
        background-color: white;
        padding-bottom: 10px;
        border-radius: 7px;
        padding: 20px;
        bottom: 7px;
    }
    
    #post_wrapper {
        width: 45%;
        min-height: 120px;
        height: auto;
        background-color: white;
        padding: 20px;
        border-radius: 5px;
        font-family: Roboto;
    }
    
    .submit_post {
        width: 95%;
        min-height: 70px;
        height: auto;
        border-color: #EEE;
        background-color: white;
        text-align: left;
        padding: 10px;
        border-radius: 5px;
    }
    
    .class {
        width: 95%;
        min-height: 20px;
        height: auto;
        border-color: #EEE;
        background-color: white;
        text-align: left;
        padding: 10px;
        border-radius: 5px;
    }
    
    #post_img {
        border-radius: 30px;
        height: 50px;
        width: 50px;
    }
    
    .post_top {
       display: inline-block;
    }
    
    [contenteditable=true]:empty:before{
        font-family: Roboto;
        content: attr(placeholder);
        display: block;
        color: #CCC;
    }
    
    div[contenteditable=true] {
        font-family: Roboto;
    }
    
    ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
        background-color: white;
        border-bottom: 1px solid #CCC;
        font-family: Roboto;
        text-align: center;
        width: 100%;
        margin: 0 auto;
        margin-right: -3000px;
        padding-right: 3000px;
        margin-left: -3000px;
        padding-left: 3000px;
        margin-top: -100px;
        padding-top: 100px;
        position: fixed;
        z-index: 2;
    }

    li {
        float: left;
        display: inline-block;
        font-size: 15px;
        color: skyblue;
    }

    li a {
        display: inline-block;
        color: #424242;
        /*text-align: center;*/
        padding: 14px 16px;
        text-decoration: none;
    }

    li a:hover {
    }
    
    .header {
        width: 100%;
        height: 70px;
        border-bottom: 1px solid #CCC;
        text-align: center;
        padding: 15px 0px 0px;
        padding-left: 5px;
        font-size: 20px;
        font-weight: normal;
        position: fixed;
        top: -5px;
        background-color: white;
        z-index: 3;
        font-family: Roboto;
    }
    
    .wrapper {
        position: relative;
        top: -10px;
        display: block;
        right: 10px;
    }
    
    #element {
        text-decoration: none;
        color: grey;
        font-size: 15px;
        position: relative;
        bottom: 25px;
    }
</style>