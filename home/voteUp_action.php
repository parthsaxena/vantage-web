<?php
include '../header.php';
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