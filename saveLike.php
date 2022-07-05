<?php 
    include "config.php";
    session_start();
    $userId = $_POST['userId'];
    $posId = $_GET['id'];
    $likerId = $_SESSION['user'];
    $sql1 = "SELECT * FROM likes WHERE post_id={$posId} AND liker_id={$likerId}";
    $query1 = mysqli_query($con, $sql1);
    if(mysqli_num_rows($query1) == 0){
        $sql = "INSERT INTO likes (post_id, liker_id) Values ({$posId}, {$likerId});";
        $sql .= "INSERT INTO notifications (user_id, friend_id, post_id, message) Values ({$userId}, {$likerId}, {$posId}, 'liked your post')";
        $query = mysqli_multi_query($con, $sql);
    }else{
        $sql = "DELETE FROM likes WHERE post_id={$posId} AND liker_id={$likerId};";
        $sql .= "ALTER TABLE likes AUTO_INCREMENT=1;";
        $sql .= "DELETE FROM notifications WHERE user_id={$userId} AND friend_id={$likerId} AND post_id={$posId} AND message='liked your post'";
        $query = mysqli_multi_query($con, $sql);
    }
?>