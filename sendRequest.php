<?php
session_start();
include "config.php";
$id = $_GET['id'];
if(isset($_POST['add'])){
    $userGetId = $id;
    $userSentId = $_SESSION['user'];
    $sql1 = "INSERT INTO requests (user_get_id, user_sent_id) VALUES ({$userGetId},{$userSentId});";
    $sql1 .= "INSERT INTO notifications (user_id, friend_id, message) VALUES ({$userGetId},{$userSentId}, 'sent you a friend request');";
    $query1 = mysqli_multi_query($con, $sql1);
    $_SESSION['active'] = 'cancelBtn';
    $_SESSION['get_id'] = $id;
    header("Location: profile.php?id={$id}");
}else if(isset($_POST['cancel'])){
    $userGetId = $id;
    $userSentId = $_SESSION['user'];
    $sql1 = "DELETE FROM requests WHERE user_get_id={$userGetId} AND user_sent_id={$userSentId}; ALTER TABLE requests AUTO_INCREMENT=1;";
    $query1 = mysqli_multi_query($con, $sql1);
    $_SESSION['active'] = null;
    header("Location: profile.php?id={$id}");
}else if(isset($_POST['confirm'])){
    $sql1 = "SELECT * FROM requests WHERE user_get_id={$_SESSION['user']};";
    $sql1 .= "INSERT INTO notifications (user_id, friend_id, message) VALUES ({$userSentId}, {$userGetId}, 'accepted your friend request')";
    $query1 = mysqli_multi_query($con, $sql1);
    $result1 = mysqli_fetch_assoc($query1);
    $sql = "SELECT * FROM users WHERE id = {$result1['user_sent_id']}";
    $query = mysqli_query($con, $sql);
    if(mysqli_num_rows($query) > 0){
        $result = mysqli_fetch_assoc($query);
    }
        $userId = $_SESSION['user'];
        $friendId = $result['id'];
        $sql1 = "INSERT INTO friends (user_id, friend_id) VALUES ({$userId}, {$friendId});
                 INSERT INTO friends (user_id, friend_id) VALUES ({$friendId}, {$userId});
                 DELETE FROM requests WHERE user_sent_id={$friendId}";
        $query1 = mysqli_multi_query($con, $sql1);
        $_SESSION['request_get'] = false;
        header("Location: profile.php?id={$friendId}");
}else if(isset($_POST['message'])) {
    $sql = "SELECT * FROM users WHERE id = $id";
    $query = mysqli_query($con, $sql);
    if($query){
        $result = mysqli_fetch_assoc($query);
    }
    header("Location: messages.php?id={$result['id']}");
}


?>