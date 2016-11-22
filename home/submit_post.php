<?php

  session_start();
  include '../conn.php';

  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  if (!isset($_SESSION['user'])) {
    //no session set, redirect to login
    header('Location: ../login');
    die();
  }

  $username = $_SESSION['user'];
  $user_query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
  $user = mysqli_fetch_assoc($user_query);

  $school = $user["school"];
  $district = $user["district"];

  $profile_picture = $user["profile_picture"];
  $title = $_POST['title'];
  $content = $_POST['content'];
  $class = $_POST['class'];
    //echo $class;

    $errors= array();
      $file_name = $_FILES['image']['name'];
      $file_size =$_FILES['image']['size'];
      $file_tmp =$_FILES['image']['tmp_name'];
      $file_type=$_FILES['image']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
      
      $expensions= array("jpeg","jpg","png", "gif");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 2097152){
         $errors[]='File size must be excately 2 MB';
      }

     $ext = pathinfo($file_name, PATHINFO_EXTENSION);
      
      $name = hash('ripemd160', $file_name).".".$ext;

      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"../images/posts/".$name);
         echo "Success";
      }else{
         print_r($errors);
      }

  $image = "http://scapter.org/pinder/images/posts/".$name;

echo $image;

  $query = "INSERT INTO posts (profile_picture, posted_by, school, district, title, content, class, image) VALUES ('$profile_picture', '$username', '$school', '$district', '$title', '$content', '$class', '$image')";
  $result_insert = mysqli_query($conn, $query);

  if (!$result_insert) {
    //error inserting post
    die("Error on query.".mysqli_error($conn));
  } else {
    header('Location: index.php');
  }

?>
