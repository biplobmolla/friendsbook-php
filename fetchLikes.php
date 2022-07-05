<?php
    include "config.php";
    session_start();
    $id = $_SESSION['user'];
    $getId = $_GET['id'];
    $sql = "SELECT * FROM likes WHERE post_id={$getId}";
    $query = mysqli_query($con, $sql);
    $data = mysqli_num_rows($query);
    echo $data;
?>