<?php
    session_start();
    include "config.php";
    if(isset($_POST['msg_send'])){
        $id = $_SESSION['user'];
        $userGetId = $_GET['id'];
        $messsage = $_POST['msg'];
        $sql4 = "INSERT INTO messages (user_get_id, user_sent_id, message) VALUES ({$userGetId}, {$id}, '{$messsage}')";
        $query4 = mysqli_query($con, $sql4);
        if($query4){
            header("Location: messages.php?id={$userGetId}");
        }
    }

?>