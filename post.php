<?php
    session_start();
    include "config.php";
    if(!isset($_SESSION['user'])){
        header("Location: login.php");
    }
    $id = $_GET['id'];

    $sql = "SELECT * FROM users WHERE id = {$id}";
    $query = mysqli_query($con, $sql);
    $sql1 = "SELECT * FROM posts ORDER BY id DESC";
    $query1 = mysqli_query($con, $sql1);
    if($query){
        if(mysqli_num_rows($query) > 0){
            $result = mysqli_fetch_assoc($query);
        }
    }
    $result1 = mysqli_fetch_assoc($query1);
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
                    <a href="notifications">Notifications <span class="count">(<?php echo  $count; ?>)</span></a>
                </li>
            </ul>
            <a class="logout__btn" href="logout.php">Logout</a>
        </div>
    </nav>
    <div class="posts">
        <div class="post">
            <div class="post__header">
                <img src="profile.jpg" alt="profile pic">
                <div class="post__header__text">
                    <a href="profile.php?id=<?php echo $result1['user_id']; ?>" class="post__creator"><?php echo $result1['name']; ?></a>
                    <span class="post__time">5:20</span>
                </div>
            </div>
            <div class="post__desc"><?php echo $result1['description']; ?></div>
            <img class="post__img" src="./profile.jpg" alt="Post Image" />
        </div>
    </div>


    <script src="main.js"></script>
</body>

</html>

<?php include "style.php"; ?>