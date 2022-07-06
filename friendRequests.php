<?php
    session_start();
    include "config.php";
    $id = $_SESSION['user'];
    $sql = "SELECT * FROM users WHERE id={$id}";
    $query = mysqli_query($con, $sql);
    $result = mysqli_fetch_assoc($query);
    $sql1 = "SELECT * FROM requests WHERE user_get_id={$id}";
    $query1 = mysqli_query($con, $sql1);
    $friendRequestCount = mysqli_num_rows($query1);

    $sql4 = "SELECT * FROM friends";
    $query4 = mysqli_query($con, $sql4);
    if(mysqli_num_rows($query4) > 0){
        $result4 = mysqli_fetch_assoc($query4);
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Friend Request</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav>
        <div class="max__width">
        <a class="profile__fullname" href="profile"><?php echo $result['fname'] . " " . $result['lname']; ?></a>
            <ul>
            <script>
                    $(document).ready(function(){
                        function loadNotifications(){
                            $.ajax({
                            url: "fetchNotifications.php",
                            type: "POST",
                            success: function(data){
                                if(data > 0){
                                    var span = document.createElement("span");
                                    span.innerHTML = data;
                                    document.querySelector(".notificationLink").appendChild(span);
                                }
                            }
                        });
                        }
                        loadNotifications();
                    });


                </script>
                <li>
                    <a href="<?php echo $localhost; ?>">Home</a>
                </li>
                <li>
                    <a class="active" href="friendRequests">Friend Requests</a>
                </li>
                <li>
                    <a href="friends">Friends</a>
                </li>
                <li>
                    <a class="notificationLink" href="notifications">Notifications</a>
                </li>
                <li>
                    <a href="messages.php?id=<?php echo $result4['friend_id']; ?>">Messages</a>
                </li>
            </ul>
            <a class="logout__btn" href="logout.php">Logout</a>
        </div>
    </nav>

    <div class="notifications">
        <h2 class="notification__top__title">Friend Requests. (<?php echo $friendRequestCount; ?>)</h2>
       <?php
            if(mysqli_num_rows($query1) > 0) { 
            while($result1 = mysqli_fetch_assoc($query1)){ 
            $sql2 = "SELECT * FROM users WHERE id = {$result1['user_sent_id']}";
            $query2 = mysqli_query($con, $sql2);
            if(mysqli_num_rows($query2) > 0){
                $result2 = mysqli_fetch_assoc($query2);
            }
        ?>
        <a href="profile.php?id=<?php echo $result2['id']; ?>" class="notification">
            <div class="notification__info">
                <img src="./images.png" alt="Notification Image">
                <div class="notification__text">
                    <h2 class="notification__title"><?php echo $result2['fname'] . " " . $result2['lname']; ?>
                    </h2>
                    <div class="buttons">
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                            <button type="submit" name="confirm" class="friend__request__btn"><i class="fa-solid fa-check"></i> Confirm</button>
                            <button type="submit" name="delete" class="friend__request__btn"><i class="fa-solid fa-xmark"></i> Delete</button>
                        </form>
                    </div>
                </div>
            </div>
            <i class="fa-solid fa-comment"></i>
        </a>
      <?php }
      }else{
            echo "<h1>No Friend requests to show</h1>";
        } ?>

      <?php if(isset($_POST['confirm'])) {
        $userId = $_SESSION['user'];
        $friendId = $result2['id'];
        $sql1 = "INSERT INTO friends (user_id, friend_id) VALUES ({$userId}, {$friendId});
                 INSERT INTO friends (user_id, friend_id) VALUES ({$friendId}, {$userId});
                 DELETE FROM requests WHERE user_sent_id={$friendId};
                 INSERT INTO notifications (user_id, friend_id, message) VALUES ({$userId}, {$friendId}, 'accepted your friend request')";
        $query1 = mysqli_multi_query($con, $sql1);
        header("Location: friendRequests");
    }else if(isset($_POST['delete'])){
        $userId = $_SESSION['user'];
        $friendId = $result2['id'];
        $sql3 = "DELETE FROM requests WHERE user_sent_id={$friendId}; ALTER TABLE requests AUTO_INCREMENT=1;";
        $query3 = mysqli_multi_query($con, $sql3);
        $_SESSION['request_get'] = false;
        header("Location: friendRequests");
    } ?>
    
    </div>
    <script src="main.js"></script>
</body>

</html>

<?php include "style.php"; ?>