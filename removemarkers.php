<?php
    include "config.php";
    $id = $_GET['id'];
    if($id == 'requests'){
        $sql = "SELECT * FROM requests WHERE readRequests=0";
        $query = mysqli_query($con, $sql);
        if(mysqli_num_rows($query) > 0){
            $sql1 = "UPDATE requests SET readRequests=1 WHERE readRequests=0";
            $query1 = mysqli_query($con, $sql1);
        }
        header("Location: friendrequests.php");
    }

?>