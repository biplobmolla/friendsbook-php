<?php
    session_start();
    include "config.php";
    if(!isset($_SESSION['user'])){
        header("Location: login.php");
    }
    $id = $_SESSION['user'];
    $sql = "SELECT * FROM users WHERE id = {$id}";
    $query = mysqli_query($con, $sql);
    if($query){
        if(mysqli_num_rows($query) > 0){
            $result = mysqli_fetch_assoc($query);
        }
    }

    $count = "";
    $sql2 = "SELECT * FROM requests WHERE user_get_id={$id} AND readRequests=0";
    $query2 = mysqli_query($con, $sql2);
    if(mysqli_num_rows($query2) > 0){
        $count = mysqli_num_rows($query2);
    }

    $sql1 = "SELECT * FROM users LEFT JOIN friends ON users.id=friends.friend_id WHERE user_id={$_SESSION['user']}";
    $query1 = mysqli_query($con, $sql1);

    $sql3 = "SELECT * FROM messages WHERE user_get_id={$id} OR user_sent_id={$id}";
    $query3 = mysqli_query($con, $sql3);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facebook</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
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
                    <a href="removemarkers.php?id=requests">Friend Requests<?php if($count){ echo "<span>{$count}</span>"; }?></a>
                </li>
                <li>
                    <a href="friends">Friends</a>
                </li>
                <li>
                    <a class="notificationLink" href="notifications">Notifications</a>
                </li>
                <li>
                    <a class="active" href="messages.php?id=<?php echo $result4['friend_id']; ?>">Messages</a>
                </li>
            </ul>
            <a class="logout__btn" href="logout.php">Logout</a>
        </div>
    </nav>
    <div class="message__box">
        <div class="max__width">
            <aside>
                <ul>
                <?php  
                    if(mysqli_num_rows($query1) > 0) {
                    while($result1 = mysqli_fetch_assoc($query1)){ 
                        if($_GET['id'] == $result1['friend_id']){
                            $_SESSION['fname'] = $result1['fname'];
                            $_SESSION['lname'] = $result1['lname'];
                            $_SESSION['f_id'] = $result1['friend_id'];
                            $active = "active";
                        }else{
                            $active = " ";
                        }
                    ?>
                    <li>
                        <a class="<?php echo $active; ?>" href="messages.php?id=<?php echo $result1['friend_id']; ?>">
                            <img src="profile.jpg" alt="" />
                            <h2><?php echo $result1['fname'] . " " . $result1['lname']; ?></h2>
                        </a>
                    </li>
                    <?php } } ?>
                </ul>
            </aside>
            <div class="message__field">
                <header>
                    <a href="profile.php?id=<?php echo $_SESSION['f_id']; ?>">
                        <img src="profile.jpg" alt="" />
                        <h2><?php echo $_SESSION['fname'] . " " . $_SESSION['lname']; ?></h2>
                    </a>
                </header>
                <div class="all__messages">
                    <ul>
                        <?php
                        if(mysqli_num_rows($query3) > 0){
                            while($result3 = mysqli_fetch_assoc($query3)){
                                if(($result3['user_sent_id'] == $id) && ($result3['user_get_id'] == $_GET['id'])){
                                    echo "<li class='left'>
                                    <img src='profile.jpg' alt='' />
                                    <span>{$result3['message']}</span>
                                </li>";
                                }else if(($result3['user_get_id'] == $id) && ($result3['user_sent_id'] == $_GET['id'])){
                                    echo "<li class='right'>
                                    <span>{$result3['message']}</span>
                                    <img src='profile.jpg' alt='' />
                                </li>";
                                } } }else{
                                    echo "<h1 class='no__msg'>There is no message.</h1>";
                                } ?>
                    </ul>
                </div>
                <div class="message__send">
                    <form action="messageSend.php?id=<?php echo $_SESSION['f_id']; ?>" method="POST" >
                        <input name="msg" type="text" placeholder="Message" />
                        <input name="msg_send" class="msg__send" type="submit" value="Send" />
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="main.js"></script>
</body>

</html>

<?php include "style.php"; ?>