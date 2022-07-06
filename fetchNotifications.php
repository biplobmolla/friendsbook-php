<?php
    include "config.php";
    session_start();

    $sql = "SELECT * FROM notifications WHERE user_id={$_SESSION['user']} AND readNotification=0";
    $query = mysqli_query($con, $sql);
    if(mysqli_num_rows($query) > 0){
        echo mysqli_num_rows($query);
    }

?>