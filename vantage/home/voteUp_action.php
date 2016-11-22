
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
        	background-image: url(http://vantage.social/vantage/images/bg/night/night-1.jpeg);
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
<?php
//include '../header.php';
include '../sessions/user.php';
include '../conn.php';

$id = $_GET["id"];
$currentUsername = $_SESSION["user"];

$checkUser = false;
$findUpvotesQuery = mysqli_query($conn, "SELECT * FROM posts_votes WHERE post_id='$id' ");

while ($upvoteRow = $findUpvotesQuery->fetch_array()) {
    if ($upvoteRow['voted_from'] == $currentUsername) {
        // User already upvoted
        $checkUser = true;        
    } else {
        // User has not upvoted
        $checkUser = false;        
    }
}

if ($checkUser) {
    // User has already upvoted, un-upvote the post
    $unUpvoteQuery = mysqli_query($conn, "DELETE FROM posts_votes WHERE voted_from='$currentUsername' AND post_id='$id' ");
    if (!$unUpvoteQuery) {
        echo mysqli_error($conn);
    } 
} else {
    // User has not upvoted, upvote the post
    $upvoteQuery = mysqli_query($conn, "INSERT INTO posts_votes (voted_from, post_id, up_or_down) VALUES ('$currentUsername', '$id', 'up') ");
    if (!$upvoteQuery) {
        echo mysqli_error($conn);
    }
}

?>
<script>
    javascript:history.go(-1);
</script>