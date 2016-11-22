<?php
include "../sessions/user.php";
include "../header.php";
include "notify_query.php";
?>

<title>Vantage | Notifications</title>

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

    p {
        opacity: 1;
    }
</style>
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
              <div id="container">
                <center>
                  <a style="float: right; margin-right: 150px;" href="/vantage/activity" class="btn btn-info">Dismiss Notifications</a>
                  <br>
                  <br>
                  <br>
                  <?php
                  while($row = $query->fetch_array()) {
                    $posted_by = $row['posted_by'];
                    $content = $row['content'];
                    $post_id = $row['post_id'];
                    $query = mysqli_query($conn, "SELECT * FROM posts WHERE id = '$post_id'");
                    $result = mysqli_fetch_assoc($query);
                    $title = $result["title"];  
                      
                    if ($posted_by == $user){
                    }
                    else {
                      echo "<center><div id='post_div'>
                            <h5 style='margin-right:80%;'><a href='/vantage/profile?u=$posted_by'>$posted_by</a></h4>
                            <center><p><a href='/vantage/home/post.php?id=$post_id'>$title</a><br>$content</p><br></center><br>
                          </div><br><br><center>";
                    }
                  }
              $yes = "y";
              $read_query = mysqli_query($conn, "UPDATE comments SET read_y_n = '$yes' WHERE user_sent_to = '$user_int' AND
                read_y_n NOT LIKE '%$yes%' ");
                if (!$read_query){
                  echo("Error description: " . mysqli_error($conn));
                }
                    
                $user_mention = "*".$user."*";
                
                $m_query = mysqli_query($conn, "SELECT * FROM comments WHERE content LIKE '%$user_mention%' ");
                    
                if (!$m_query){
                    echo mysqli_error($conn);
                }

                while($row = $m_query->fetch_array()) {
                    
                    $posted_by = $row['posted_by'];
                    $content_1 = $row['content'];
                    $post_id = $row['post_id'];
                    $query = mysqli_query($conn, "SELECT * FROM posts WHERE id = '$post_id'");
                    
                    if (!$query){
                        echo mysqli_error($conn);
                    }
                    
                    else {
                        //echo "Nothing is wrong";
                    }
                    
                    $result = mysqli_fetch_assoc($query);
                    $title = $result["title"]; 
                    
                    $content = str_replace("*", "", $content_1);
                    
                    echo "<center><div id='post_div'>
                            <h5 style='margin-right:80%;'><a href='/vantage/profile?u=$posted_by'>$posted_by</a></h4>
                            <center><p><a href='/vantage/home/post.php?id=$post_id'>$title</a><br>$content<br><br></p></center><br>
                          </div><br><br><center>";
                }
                ?>
                </center>
              </div>
            </div>
          </div>
      </div>
</div>
