<?php

    include "config.php";
    session_start();
    $id = $_GET['id'];
    $sql5 = "SELECT * FROM comments WHERE post_id={$id}";
    $query5 = mysqli_query($con, $sql5);
    if(mysqli_num_rows($query5) > 0){
        $result5 = mysqli_fetch_assoc($query5);
        $data = $result5['commenter_name'] . "," . $result5['comment'] . "," . mysqli_num_rows($query5);
        echo $data;
    }

?>