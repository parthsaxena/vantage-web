<?php
  if (isset($_POST['changed_school'])){
    $changed_school = $_POST['change_school'];
    $change_school_query = mysqli_query($conn, "UPDATE users SET school = '$changed_school' WHERE username = '$user' ");
      if (!$change_school_query){
        echo "Error.";
      }
  }

  if (isset($_POST['changed_profile_picture'])){
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
      
      $name = hash('ripemd160', $file_name);

      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"../images/profile_pictures/".$name);
         echo "Profile Picture Changed";
      }else{
         print_r($errors);
      }

  $image = "http://scapter.org/pinder/images/profile_pictures/".$name;
      
    $change_profile_picture_query = mysqli_query($conn, "UPDATE users SET profile_picture = '$image' WHERE username = '$user' ");
      if (!$change_profile_picture_query){
        echo "Error.";
      }
  }

?>
