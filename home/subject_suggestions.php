<?php
    include('../conn.php');
    $key = $_GET['key'];
    $array = array();
    $query = mysqli_query($conn, "SELECT * FROM approved_subjects WHERE name1 LIKE '%{$key}%'");
    while($row = $query->fetch_array()) {
        $array[] = $row["name1"];
    }
    echo json_encode($array);
?>