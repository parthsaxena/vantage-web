<?php
    include '../sessions/user.php';
    include '../conn.php';

    $id = $_GET["id"];

    $checkUserQuery = mysqli_query($conn, "SELECT * FROM posts WHERE id='$id'");
    while ($row = $checkUserQuery->fetch_array()) {
        if ($row["posted_by"] == $_SESSION["user"]) {
            // User truly owns post trying to delete
            $deletePostQuery = mysqli_query($conn, "DELETE FROM posts WHERE id='$id' ");
            $deleteUpvotesQuery = mysqli_query($conn, "DELETE FROM posts_votes WHERE post_id='$id' ");
            
            $username = $_SESSION["user"];
            
            if ($deletePostQuery && $deleteUpvotesQuery) {
                // Successfully delete post
                echo "Successfully deleted post!";
                echo "<br><a href='javascript:history.go(-1);'>Back</a>";
            } else {
                // Failed to delete posts
                echo "Something Went Wrong... Please Try Again Later.";
                echo "<br><a href='http://scapter.org/pinder/profile/?u=$username'>Back</a>";
            }
        } else {
            // USER ATTEMPTED TO DO SOMETHING MEAN
            die("Did you really think it was that easy?");
        }
    }

?>