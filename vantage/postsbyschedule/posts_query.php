<?php

    $username = $_SESSION['user'];

    $get_user_data = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
    if ($get_user_data) {
        $user_data = mysqli_fetch_assoc($get_user_data);

        /// GET USER SCHEDULE
        $period_one = $user_data['first_period'];
        $period_two = $user_data['second_period'];
        $period_three = $user_data['third_period'];
        $period_four = $user_data['fourth_period'];
        $period_five = $user_data['fifth_period'];
        $period_six = $user_data['sixth_period'];
        $period_seven = $user_data['seventh_period'];
        $period_eigth = $user_data['eighth_period'];
        ///

        $get_query = mysqli_query($conn, "SELECT * FROM posts WHERE ")

    }


 ?>
