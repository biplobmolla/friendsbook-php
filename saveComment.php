<?php
    include "config.php";
    session_start();
    $id = $_SESSION['user'];
    $postId = $_GET['id'];
    $comment = $_POST['comment'];
    $name = $_SESSION['name'];
    $sql = "INSERT INTO comments (post_id, commenter_id, commenter_name, comment) VALUES ({$postId}, {$id}, '{$name}', '{$comment}')";
    $query = mysqli_query($con, $sql);
?>