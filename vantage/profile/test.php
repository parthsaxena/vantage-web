<?php
include "../sessions/user.php";
include "../sessions/user_visiting.php";
include "../header.php";
include "query.php";
?>
<html>

	<head>
		<link rel="stylesheet" href="css/style.css" type="text/css">
		  
        <title><?php echo $username ?>'s Profile</title>
		<style>
		body {
		}
		</style>
	</head>

	<body>

		<div id="page-content-wrapper">
				<div class="container-fluid">
						<div class="row">
								<div class="col-lg-12">
									<div id="container">
                                        
                                        <form action="header.php">
                                            <button name="back123">Hi</button>
                                        </form>
                                        
                                        
                                        <?php
                                            if (isset($_POST["123"])){
                                                echo "<script>console.log('hi');</script>";
                                            }
                                        ?>

										<!-- BEGIN # MODAL LOGIN -->
													<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header" align="center">
															<img class="img-circle" height="200" width="200" id="img_logo" src="<?php
															if ($profile_picture != ""){
														    echo $profile_picture;
														  }
															else {
																echo '/'.'pinder'.'/'.'/'.'images'.'/'.'empty_profile_picture.jpg';
															}
															 ?>">
															<center>
																<?php    
                                                                    $user_hash = hash('ripemd160', $_SESSION['user']);
                                                                
                                                                    $id_combo_array = array($user_id, $user_hash);
                                                                    sort($id_combo_array);
                                                                
                                                                    $length = count($id_combo_array);
                                                                
                                                                    $combo = "";
                                                                
                                                                    for($x = 0; $x<$length; $x++){
                                                                        $combo = $id_combo_array[$x];
                                                                    }
                                                                
																	echo "<h3>$fullname</h3>";
																	echo "<p>$username</p>";
																	echo "<p>&#127891; $district</p>";
																	echo "<p>&#127979; $school</p>";
																	if ($username == $_SESSION['user']){
																		echo "<a href='edit.php'>👤 Edit Profile</a>";
																	}
																	else {
																		echo "<!--<a href='schedule.php?u=$username'><p>&#128218; View His Schedule</p></a>-->
                                                                        ";
                                                                        //openChat();
																	}
                                                                
                                                                  
																?>
																<br><br>

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
																		width: 70%;
																		/*margin-left: 3%;*/
																		background-color: #E9E7E7;
																		border-radius: 5px;
																    position: relative;
																    bottom: 60px;
																    background: rgb(200, 200, 200);
																    background: rgba(200, 200, 200, 0.8);
																	}

																	#profile_post_link {
																		margin-right: 85%;
																		font-size: 15px;
																	}

																	#panel {
																		display: none;
																	}
																  p {
																    opacity: 1;
																  }

																</style>

														</div>
													</div>
												</div>
												<!-- END # MODAL LOGIN -->
												<br><br><br>
												<?php
												$user_posts = mysqli_query($conn, "SELECT * FROM posts WHERE posted_by = '$username' ORDER BY id DESC");
												while($row = $user_posts->fetch_array()) {

													$posted_by = $row['posted_by'];
													$title = $row['title'];
													$content = $row['content'];
													$class = $row['class'];
                                                    $id = $row["id"];

													if ($posted_by != $_SESSION["user"]) {
                                                        echo "<center><div id='post_div'>
                                                                        <h5 style='margin-right:80%;'><a href='/profile?u=$posted_by'>$posted_by</a></h4>
                                                                        <center><h3>$title</h3></center><br>

                                                                        <center><p>$content</p></center><br>

                                                                        <center><p font-size='14'>&#128218; $class</p></center>

                                                                    </div><br><br><center>";
                                                    } else {
                                                        // This is the current user's post
                                                            echo "<center><div id='post_div'>
                                                                        <h5 style='margin-right:80%;'><a href='/profile?u=$posted_by'>$posted_by</a></h5>
                                                                        <h5 style='margin-left:80%; color:red !important;'><a href='deletepost.php?id=$id'>Delete Post</a></h5>
                                                                        <center><h3>$title</h3></center><br>

                                                                        <center><p>$content</p></center><br>

                                                                        <center><p font-size='14'>&#128218; $class</p></center>

                                                                    </div><br><br><center>";
                                                    }
												}
												?>
                                                
												</center>
									       <script>
                                               function openChat() {
                                                    
                                                    var combo = "<?php echo $combo; ?>";
                                                   
                                                    window.open('/pinder/chat/?id='+combo+'#contact','popUpWindow','height=500,width=800,left=100,top=100,resizable=no,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');
                                               }
                                           </script>
                                    </div>
								</div>
						</div>
				</div>
		</div>

	</body>

</html>
