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
                    <center>
                        <?php 
                            $q = $_GET["q"];
                            $query = mysqli_query($conn, "SELECT * FROM users WHERE username LIKE '%$q%' ");
                            while ($row = $query->fetch_array()) {
                                $username = $row['username'];
                                echo "<a href=../profile?u=$username>$username</a><br>";
                            }
                        ?>
                    </center>
                    </div>
                </div>
            </div>
    </div>
