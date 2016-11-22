<?php
    
    //phpinfo();

    $postID = $_POST["post_id"];
    $target_dir = "/var/www/pinder.org/public_html/pinder/images/chats";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    } 

    $target_dir = $target_dir . "/" . basename($_FILES["file"]["name"]);

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir)) {
        echo json_encode([
           "Message" => "The file " . basename($_FILES["file"]["name"]) . "has been uploaded.",
            "ImageURL" => "http://scapter.org/pinder/images/chats/" . basename($_FILES["file"]["name"]),
            "Status" => "1"            
        ]);
    } else {
        echo json_encode([
           "Message" => "Your image failed to upload.",
            "Status" => "0",
            "tmp_name" => basename($_FILES["file"]["tmp_name"]),
            "Target-Dir" => $target_dir,            
            "Error" => $_FILES["file"]["error"]
        ]);
    }
?>