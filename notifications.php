<?php
    session_start();
    include "config.php";
    $id = $_SESSION['user'];
    $sql = "SELECT * FROM notifications WHERE user_id={$id} ORDER BY id DESC";
    $query = mysqli_query($con, $sql);
    $notificationCount = mysqli_num_rows($query);
    $sql1 = "SELECT * FROM users WHERE id={$id}";
    $query1 = mysqli_query($con, $sql1);
    $result = mysqli_fetch_assoc($query1);

    $count = "";
    $sql4 = "SELECT * FROM requests WHERE user_get_id={$_SESSION['user']} AND readRequests=0";
    $query4 = mysqli_query($con, $sql4);
    if(mysqli_num_rows($query4) > 0){
        $count = mysqli_num_rows($query4);
    }

    $sql5 = "SELECT * FROM friends";
    $query5 = mysqli_query($con, $sql5);
    if(mysqli_num_rows($query5) > 0){
        $result5 = mysqli_fetch_assoc($query5);
    }

    $sql6 = "UPDATE notifications SET readNotification=1 WHERE readNotification=0";
    mysqli_query($con, $sql6);
    
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav>
        <div class="max__width">
            <a class="profile__fullname" href="profile"><?php echo $result['fname'] . " " . $result['lname']; ?></a>
            <ul>
                <li>
                    <a href="<?php echo $localhost; ?>">Home</a>
                </li>
                <li>
                    <a href="removemarkers.php?id=requests">Friend Requests<?php if($count){ echo "<span>{$count}</span>"; }?></a>
                </li>
                <li>
                    <a href="friends">Friends</a>
                </li>
                <li>
                    <a class="active notificationLink" href="notifications">Notifications</span></a>
                </li>
                <li>
                    <a href="messages.php?id=<?php echo $result5['friend_id']; ?>">Messages</a>
                </li>
            </ul>
            <a class="logout__btn" href="logout.php">Logout</a>
        </div>
    </nav>

    <div class="notifications">
        <h2 class="notification__top__title">Notifications. ( <?php echo $notificationCount; ?> )</h2>
        <?php
            if(mysqli_num_rows($query) > 0){
                while ($result = mysqli_fetch_assoc($query)) {
                    if($result['post_id']){
                        $sql2 = "SELECT * FROM posts";
                        $query2 = mysqli_query($con, $sql2);
                        if(mysqli_num_rows($query2)){
                            $result2 = mysqli_fetch_assoc($query2);
                        }
                    }
                    
                    if($result['friend_id']){
                        $sql3 = "SELECT * FROM users WHERE id = {$result['friend_id']}";
                        $query3 = mysqli_query($con, $sql3);
                        if(mysqli_num_rows($query3)){
                            $result3 = mysqli_fetch_assoc($query3);
                        }
                    }
                    ?>
                    <a href="<?php if($result['post_id']){
                        echo "post.php?id={$result['post_id']}";
                    }else if($result['friend_id']){echo "profile.php?id={$result['friend_id']}"; } ?>" class="notification">
                        <div class="notification__info">
                            <i class="fa-solid fa-bell"></i>
                            <img src="./profile.jpg" alt="Notification Image">
                            <div class="notification__text">
                                <h2 class="notification__title"><?php echo $result3['fname'] . " " . $result3['lname'] . " " . $result['message']; ?>
                                </h2>
                            </div>
                        </div>
                        <i class="fa-solid fa-ellipsis-vertical"></i>
                    </a>
        <?php }
        }else{
            echo "<h1>No Notifications to show</h1>";
        } ?>
    </div>
    <script src="main.js"></script>
</body>

</html>

<?php include "style.php"; ?>