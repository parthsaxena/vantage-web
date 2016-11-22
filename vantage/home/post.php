<?php
include "../sessions/user.php";
include "../header.php";
include "post_query.php";
?>

<style>
    #submit_post_div {
        height: auto;
        padding-bottom: 30px;
        width: 70%;
        margin-left: 3%;
        background-color: #E9E7E7;
        border-radius: 5px;
        position: relative;
        bottom: 60px;
        background: rgb(200, 200, 200);
        background: rgba(200, 200, 200, 0.5);
        display: inline-block;
    }

    #post_div {
        overflow: auto;
        width: 70%;
        margin-left: 3%;
        background-color: #E9E7E7;
        border-radius: 5px;
        position: relative;
        background: rgb(200, 200, 200);
        background: rgba(200, 200, 200, 0.7);
    }

    #profile_post_link {
        margin-right: 85%;
        font-size: 15px;
    }

    .center {

    }

    /*#panel {
        display: none;
    }*/

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
    
    p {
        opacity: 1;
    }
    
    .content {
        position: relative;
        bottom: 90px;
    }
</style>
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
              <div id="container">
                  <div class="content">
              <a onclick="window.history.back();">< Back</a>
                <?php
              if (!$query){
                echo "Error. ".$mysqli_error($conn);
              }
              while($row = $query->fetch_array()) {

                $posted_by = $row['posted_by'];
                $title = $row['title'];
                $content = $row['content'];
                $class = $row['class'];
                $id = $row['id'];
                $image = $row['image'];

                $currentUsername = $_SESSION["user"];
                $findUpvotesQuery = mysqli_query($conn, "SELECT * FROM posts_votes WHERE post_id='$id'");
                $UPVOTES = 0;
                $checkUser = false;
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
                  
                echo "<center><div id='post_div'>
                        <h5 style='margin-right:80%;'><p style='color: #E53935; position: relative; '><img src='http://vantage.social/vantage/images/empty_profile_picture.jpg' height='50' width='50' class='img-circle' style='color: red;'> <i>Anonymous</i></p></h4>
                        <center><h3>$title</h3></center><br>

                        <center><p>$content</p></center><br>
                        
                        <center><p font-size='14'>&#128218; $class</p></center><br>";
                  
                if ($image != ""){
                     echo "<img src='$image' height='300'><br>";
                }
                  
                if ($checkUser) {
                    // User already upvoted post
                    echo "<p> 
                        <form action='voteUp_action.php?id=$id' method='POST'>
                                                <button title='You are a big bafoon farto quoe. You can only upvote a post once you big bafoon.' id='up_$id' class='btn btn-success btn-mean' align='right' name='up_".$id."' type='sumbit'>
                                    <span class='glyphicon glyphicon-thumbs-up'></span>&nbsp;&nbsp;&nbsp;$UPVOTES</button>
                                    </form></p>

                      </div><br><br><center>";
                } else {
                    // User has not already upvoted post
                     echo "<p>
                         <form action='voteUp_action.php?id=$id' method='POST'>
                           <button class='btn btn-success btn-cool' align='right' name='up_".$id."' type='sumbit'>
                         <span class='glyphicon glyphicon-thumbs-up'></span>&nbsp;&nbsp;&nbsp;$UPVOTES</button>
                       </form>
                    </p>
		  </div><br><br><br><br><center>";
                }
              }
            ?>
            <br><br>
            <div id="submit_post_div">
              <br>
            <div class="center">
            <form action="" method="POST">
              <textarea style="resizable: verticle; width: 80%; height: 85px; padding-left: 15px; border: none; border-radius:5px; margin-left: 2px;"
              type="text" name="content" placeholder="Comment or Answer the Question..." required></textarea>
              <br><button style="height: 45px;" class="btn btn-success" type="sumbit" name="submit_comment">Post</button>
            </form>

          </div>
          </div>
            <?php
              if (isset($_POST['submit_comment'])){
                include "comment_query.php";
              }
            ?>
            <?php

          $query = mysqli_query($conn, "SELECT * FROM comments WHERE post_id = '$id' ORDER BY id DESC ");

          while($row = $query->fetch_array()) {

            $posted_by = $row['posted_by'];
            $content = $row['content'];
            echo "<center><div id='post_div'>
                    <h5 style='color:red !important;'><p style='color: #E53935; position: relative; right: 40%;'><img src='http://vantage.social/vantage/images/empty_profile_picture.jpg' height='50' width='50' class='img-circle' style='color: red;'> <i>Anonymous</i></p></h5>           
                    <center><p>$content</p></center><br>
                  </div><br><br><center>";
          }
                  
            echo "<title>Vantage | Post</title>";
                  
        ?>
        </div>
              </div>
            </div>
          </div>
        </div>
      </div>
