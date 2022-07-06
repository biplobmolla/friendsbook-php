<?php
    session_start();
    include "config.php";
    if(!isset($_SESSION['user'])){
        header("Location: login.php");
    }
    $id = $_SESSION['user'];
    $sql = "SELECT * FROM users WHERE id = {$id}";
    $query = mysqli_query($con, $sql);
    $sql1 = "SELECT * FROM posts ORDER BY id DESC";
    $query1 = mysqli_query($con, $sql1);
    if($query){
        if(mysqli_num_rows($query) > 0){
            $result = mysqli_fetch_assoc($query);
        }
    }

    if(isset($_POST['post'])){
        if(!empty($_POST['desc'])){
            $image = "";
            $desc = $_POST['desc'];
            $name = $result['fname'] . " " . $result['lname'];
            if($_FILES['image']['error'] == 0){
                $img_tmp_name = $_FILES['image']['tmp_name'];
                $img_name = $_FILES['image']['name'];
                $img_full_path = $_FILES['image']['full_path'];
                $img_type = $_FILES['image']['type'];
                $img_error = $_FILES['image']['error'];
                $img_size = $_FILES['image']['size'];

                if(!empty($img_name)){
                    if($img_type == 'image/jpg' || $img_type == 'image/png' || $img_type == 'image/jpeg'){
                        if($img_size <= 5242880){
                            $image = $img_name;
                            move_uploaded_file($img_tmp_name, 'upload/' . $img_name);
                        }
                    }
                }
            }
            date_default_timezone_set("Asia/Dhaka");
            $sec = date("s");
            $min = date("i");
            $hour = date("G");
            $day = date("d");
            $year = date("Y");
            $sql2 = "INSERT INTO posts (user_id, name, description, image, sec, min, hour, day, year) VALUES ({$id}, '{$name}', '{$desc}', '{$image}', {$sec}, {$min}, {$hour}, {$day}, {$year})";
            $query2 = mysqli_query($con, $sql2);
            if($query2){
                header("Location: index.php");
            }
        }
    }
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
    <title>Facebook</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
                    <a class="active" href="<?php echo $localhost; ?>">Home</a>
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
                    <a href="messages.php?id=<?php echo $result4['friend_id']; ?>">Messages</a>
                </li>
            </ul>
            <a class="logout__btn" href="logout.php">Logout</a>
        </div>
    </nav>

    <div class="add__post">
        <form class="add__post__form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
            <!-- <label class="upload__image__label" for="uploadImage">
                <i class="fa-solid fa-image"></i>
            </label> -->
            <input name="image" type="file" id="uploadImage" />
            <div class="add__post__input__field">
                <textarea name="desc" class="add__post__input" rows="5" placeholder="Post something..."></textarea>
                    <button type="submit" name="post">Post</button>
            </div>
        </form>
    </div>

    <div class="posts">
        <?php if(mysqli_num_rows($query1) > 0) {
            while($result1 = mysqli_fetch_assoc($query1)){ ?>
            <div class="post">
                <div class="post__header">
                    <img src="images.png" alt="profile pic">
                    <div class="post__header__text">
                        <a href="profile.php?id=<?php echo $result1['user_id']; ?>" class="post__creator"><?php echo $result1['name']; ?></a>
                        <span class="post__time"><?php 
                        
                            $post_year = $result1['year'];
                            $post_day = $result1['day'];
                            $post_hour = $result1['hour'];
                            $post_min = $result1['min'];
                            $post_sec = $result1['sec'];
                        
                            $present_year = date("Y");
                            $present_day = date("d");
                            $present_hour = date("G");
                            $present_min = date("i");
                            $present_sec = date("s");

                            $d_year = $present_year - $post_year;
                            $d_day =  $present_day - $post_day;
                            $d_hour = $present_hour - $post_hour;
                            $d_min = $present_min - $post_min;
                            $d_sec = $present_sec - $post_sec;

                            if($d_year > 0){
                                echo "{$d_year} year ago";
                            }else if($d_day > 0){
                                echo "{$d_day} day ago";
                            }else if($d_hour > 0){
                                echo "{$d_hour} hour ago";
                            }else if($d_min > 0){
                                echo "{$d_min} minutes ago";
                            }else if($d_sec > 0){
                                echo "{$d_sec} seconds ago";
                            }


                        ?></span>
                    </div>
                </div>
                <div class="post__desc"><?php echo $result1['description']; ?></div>
                <?php
                    if($result1['image'] != ""){
                        echo "<img class='post__img' src='upload/{$result1['image']}' alt='Post Image' />";
                    }
                
                ?>
                <div class="post__actions">
                    <div id="like_<?php echo $result1['id']; ?>" class="post__action">
                        <i name="likeBTN" class="fa-solid fa-thumbs-up"></i> <span id="like_span_<?php echo $result1['id']; ?>"></span>
                    </div>
                    <div id="comment_<?php echo $result1['id']; ?>" class="post__action">
                        <i class="fa-solid fa-comments"></i> <span id="comment_span_<?php echo $result1['id']; ?>">0</span>
                    </div>
                    <div id="share_<?php echo $result1['id']; ?>" class="post__action">
                        <i class="fa-solid fa-share-nodes"></i> <span>0</span>
                    </div>
                    <script>
                        $(document).ready(function(){
                            function loadLikes(){
                                $.ajax({
                                    url: "fetchLikes.php?id=<?php echo $result1['id']; ?>",
                                    type: "POST",
                                    success: function(data){
                                        $("#like_span_<?php echo $result1['id']; ?>").html(data);
                                    }
                                });
                            }
                            loadLikes();
                            $("#like_<?php echo $result1['id']; ?>").on("click", function(){
                                $.ajax({
                                    url: 'saveLike.php?id=<?php echo $result1['id']; ?>',
                                    type: 'POST',
                                    data: { userId: <?php echo $result1['user_id']; ?> },
                                    success: function(data){
                                        loadLikes();
                                    }
                                });
                            });
                            $("#share_<?php echo $result1['id']; ?>").on("click", function(){
                                alert("It is under construction");
                            });
                        });
                    </script>
                </div>
                <div class="comment__section" id="comment_section_<?php echo $result1['id']; ?>">
                    <div class="comment__input__box">
                        <input id="comment_desc_<?php echo $result1['id']; ?>" class="comment__input" type="text" placeholder="Place your comment" />
                        <input id="send_comment_<?php echo $result1['id']; ?>" class="comment__btn" type="submit" value="Send" />
                    </div>
                    <div class="comments">
                        <script>
                            $(document).ready(function(){
                                function loadComments(){
                                    $.ajax({
                                        url: "fetchComments.php?id=<?php echo $result1['id']; ?>",
                                        type: 'POST',
                                        success: function(data){
                                            var arr = data.split(",");
                                            $("#comment_span_<?php echo $result1['id']; ?>").html(arr[2]);
                                            $(".commenter_name").html(arr[0]);
                                        }
                                    });
                                }
                                loadComments();
                                $("#send_comment_<?php echo $result1['id']; ?>").on("click", function(){
                                    var comment = $("#comment_desc_<?php echo $result1['id']; ?>").val();
                                    $.ajax({
                                        url: "saveComment.php?id=<?php echo $result1['id']; ?>", 
                                        type: "POST",
                                        data: {comment},
                                        success: function(data){
                                            loadComments();
                                        }
                                    });
                                });
                                $("#comment_<?php echo $result1['id']; ?>").on("click", function(){
                                $("#comment_section_<?php echo $result1['id']; ?>").toggleClass("comment_active");
                                $("#comment_<?php echo $result1['id']; ?>").toggleClass("commentbtn_active");
                            });
                            });
                        </script>
                        <?php 
                            $sql5 = "SELECT * FROM comments WHERE post_id={$result1['id']}";
                            $query5 = mysqli_query($con, $sql5);
                            if(mysqli_num_rows($query5) > 0){
                                while($result5 = mysqli_fetch_assoc($query5)){ ?>
                        <div class="comment">
                            <img src="images.png" alt="" />
                            <div class="comment__info">
                                <a href="profile.php?id=<?php echo $result5['commenter_id']; ?>"><h4 id="commenter_name_<?php echo $result1['id']; ?>"><?php echo $result5['commenter_name']; ?></h4></a>
                                <span id="comment_<?php echo $result1['id']; ?>"><?php echo $result5['comment']; ?></span>
                            </div>
                        </div>
                        <?php } } ?>
                    </div>
                </div>
            </div>
        <?php } }else{
            echo "<h1 class='no__posts'>No posts to show</h1>";
        } ?>
    </div>

</body>

</html>

<?php include "style.php"; ?>