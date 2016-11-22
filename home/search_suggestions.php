<?php
    include('../conn.php');
    $key = $_GET['key'];
    $array = array();
    $query = mysqli_query($conn, "SELECT * FROM users WHERE username OR fullname LIKE '%{$key}%'");
    while($row = $query->fetch_array()) {
        //$array[] = $row['username'];
        $array[] = "<a onclick=' document.getElementById('searchbar').value = ''; ' href='../profile/?u=".$row['username']."'>".$row['username']."</a>";
    }

    echo json_encode($array);
?>