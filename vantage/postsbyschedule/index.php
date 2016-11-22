<?php
  include "../sessions/user.php";
  include '../conn.php';
  include '../header.php';
?>

    <html>

    <head>
        <title>Pinder - View Posts By Schedule</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

        <style>
            #submit_post_div {
                height: 25%; width: 70%;
                margin-left: 3%;
                background-color: #E9E7E7;
                border-radius: 5px;
                position: relative;
                bottom: 60px;
                background: rgb(200, 200, 200);
                background: rgba(200, 200, 200, 0.5);
            }
        </style>

        <script>
            $(document).ready(function() {
                $("#compose").click(function() {
                    $("#panel").slideToggle("slow");
                });
            });
        </script>
    </head>

    <body>
        <!-- Page Content -->

        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <br>
                        <br>
                        <br>
                        <center>
                            <div id="submit_post_div">
                                <br>
                                <div id="compose">
                                    <img class="img-circle" src="../images/empty_profile_picture.jpg" height="65">
                                    <p style="display: inline-block; font-size: 20px;">
                                        <?php echo $user; ?>
                                    </p>
                                </div>
                                <br>
                                <div id="panel">
                                    <form action="../submit_post.php" method="POST">
                                        <input style="border: none; width: 560px;" type="text" name='title' placeholder='Title your post...'>
                                        <br>
                                        <br>
                                        <textarea style="border: none; border-top: 1px solid #E9E7E7; width: 560px; margin-left: 2px;" name='content' id="post_content" rows="7" placeholder="Ask a question or write something interesting..."></textarea>
                                        <br>
                                        <br>
                                        <input style="border: none;" type="text" name="class" placeholder='Subject or Class (Optional)' size="60">
                                        <br>
                                        <br>
                                        <button type="submit" class="btn btn-info">Post</button>
                                    </form>
                                    <br>
                                    <br>

                                </div>

                            </div>
                        </center>
                        <br>
                        <br>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </body>

    </html>
