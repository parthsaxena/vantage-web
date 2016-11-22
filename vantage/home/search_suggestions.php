<?php
    include('../conn.php');
    $key = $_GET['key'];
    $array = array();
    $query = mysqli_query($conn, "SELECT * FROM users WHERE username OR fullname LIKE '%{$key}%'");
    while($row = $query->fetch_array()) {
        //$array[] = $row['username'];
        $array[] = $row['username'];
    }

    echo json_encode($array);
?>