<?php
    session_start();
    include "config.php";
    $id = $_SESSION['user'];
    $sql = "SELECT * FROM friends WHERE user_id = {$_SESSION['user']}";
    $query = mysqli_query($con, $sql);
    $friendsCount = mysqli_num_rows($query);
    $sql2 = "SELECT * FROM users WHERE id={$id}";
    $query2 = mysqli_query($con, $sql2);
    $result2 = mysqli_fetch_assoc($query2);

    $count = "";
    $sql3 = "SELECT * FROM requests WHERE user_get_id={$_SESSION['user']} AND readRequests=0";
    $query3 = mysqli_query($con, $sql3);
    if(mysqli_num_rows($query3) > 0){
        $count = mysqli_num_rows($query3);
    }

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
    <title>Friends</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav>
        <div class="max__width">
        <a class="profile__fullname" href="profile"><?php echo $result2['fname'] . " " . $result2['lname']; ?></a>
            <ul>
                <li>
                    <a href="<?php echo $localhost; ?>">Home</a>
                </li>
                <li>
                    <a href="removemarkers.php?id=requests">Friend Requests<?php if($count){ echo "<span>{$count}</span>"; }?></a>
                </li>
                <li>
                    <a class="active" href="friends">Friends</a>
                </li>
                <li>
                    <a href="notifications">Notifications</span></a>
                </li>
                <li>
                    <a href="messages.php?id=<?php echo $result4['friend_id']; ?>">Messages</a>
                </li>
            </ul>
            <a class="logout__btn" href="logout.php">Logout</a>
        </div>
    </nav>

    <div class="notifications">
        <h2 class="notification__top__title">Friends. ( <?php echo $friendsCount; ?> )</h2>
        <?php
            if(mysqli_num_rows($query) > 0){
                while($result = mysqli_fetch_assoc($query)){
                    $sql1 = "SELECT * FROM users WHERE id = {$result['friend_id']}";
                    $query1 = mysqli_query($con, $sql1);
                    if(mysqli_num_rows($query1) > 0){
                        $result1 = mysqli_fetch_assoc($query1);
                    } ?>
        <a href="profile.php?id=<?php echo $result1['id']; ?>" class="notification">
            <div class="notification__info">
                <img src="./profile.jpg" alt="Notification Image">
                <div class="notification__text">
                    <h2 class="notification__title"><?php echo $result1['fname'] . " " . $result1['lname']; ?>
                    </h2>
                </div>
            </div>
            <i class="fa-solid fa-comment"></i>
        </a>
        <?php   }
            }else{
                echo "<h1>No Friends to show</h1>";
            } ?>
    </div>
    <script src="main.js"></script>
</body>

</html>

<?php include "style.php"; ?>