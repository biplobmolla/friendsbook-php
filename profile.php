<?php
    session_start();
    include "config.php";
    if($_GET['id'] == 'me'){
        $id = $_SESSION['user'];
    }else{
        $id = $_GET['id'];
    }
    
    $sql = "SELECT * FROM users WHERE id = $id";
    $query = mysqli_query($con, $sql);
    
    $sql1 = "SELECT * FROM friends WHERE user_id={$_SESSION['user']} AND friend_id={$id}";
    $query1 = mysqli_query($con, $sql1);
    
    if($query){
        $result = mysqli_fetch_assoc($query);
    }

    if(mysqli_num_rows($query1) > 0){
        $query1Num = mysqli_num_rows($query1);
        $queryNumIndex = 0;
    }
    

    $sql2 = "SELECT * FROM requests WHERE user_get_id={$_SESSION['user']}";
    $query2 = mysqli_query($con, $sql2);

    if(mysqli_num_rows($query2) > 0){
        $result2 = mysqli_fetch_assoc($query2);
        $_SESSION['request_get'] = true;
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

    $sql6 = "SELECT * FROM posts WHERE user_id={$id} ORDER BY id DESC";
    $query6 = mysqli_query($con, $sql6);
?>


<!DOCTYPE html>
<html lang="en">
    
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav>
        <div class="max__width">
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
                    <a href="notifications">Notifications</a>
                </li>
                <li>
                    <a href="messages.php?id=<?php echo $result4['friend_id']; ?>">Messages</a>
                </li>
            </ul>
            <a class="logout__btn" href="logout.php">Logout</a>
        </div>
    </nav>

    <div class="profile__body">
    <aside class="about">
        <div class="about__top">
            <img class="profile__img" src="./images.png" alt="Profile Pic">
            <h2 class="profile__name"><?php echo $result['fname'] . " " . $result['lname']; ?></h2>
            <span class="bio">Web Developer</span>
          <?php  if($_SESSION['user'] != $id) { ?>
            <form action="<?php echo "sendRequest.php?id={$id}"; ?>" method="POST" class="buttons">
                <?php 
                    if(mysqli_num_rows($query1) > 0){
                        echo '<button class="about__top__btn friend">Friend</button>';
                    }else if($_SESSION['request_get'] == false){
                        if(($_SESSION['active'] == 'cancelBtn') && ($_SESSION['get_id'] == $id)){
                            echo '<button name="cancel" id="cancelRequest" class="about__top__btn"><i class="fa-solid fa-close"></i> Cancel Request</button>';
                        }else{
                            echo '<button name="add" id="addFriend" class="about__top__btn"><i class="fa-solid fa-plus"></i> Add Friend</button>';
                        }
                    }else{
                        echo '<button name="confirm" id="confirm" class="about__top__btn"><i class="fa-solid fa-check"></i> Confirm</button>';
                    }
                ?>
                <button name="message" class="about__top__btn"><i class="fa-solid fa-comment"></i> Message</button></form>
          <?php } ?>
        </div>
        <div class="about__info">
            <h2 class="about__info__title">About Info</h2>
            <div class="history">
                <h4 class="history__title">Studies:</h4>
                <p class="history__desc">Tangail Residential School and College</p>
            </div>
            <div class="history">
                <h4 class="history__title">Works at:</h4>
                <p class="history__desc">Learn To Job</p>
            </div>
        </div>
    </aside>

    <div class="posts profile__posts">
        <?php if(mysqli_num_rows($query6) > 0) {
            while($result6 = mysqli_fetch_assoc($query6)){ ?>
            <div class="post profile__post">
                <div class="post__header">
                    <img src="images.png" alt="profile pic">
                    <div class="post__header__text">
                        <a href="profile.php?id=<?php echo $result6['user_id']; ?>" class="post__creator"><?php echo $result6['name']; ?></a>
                        <span class="post__time">5:20</span>
                    </div>
                </div>
                <div class="post__desc"><?php echo $result6['description']; ?></div>
                <?php
                    if($result6['image'] != ""){
                        echo "<img class='post__img' src='upload/{$result6['image']}' alt='Post Image' />";
                    }
                
                ?>
                <div class="post__actions">
                    <div id="like_<?php echo $result6['id']; ?>" class="post__action">
                        <i name="likeBTN" class="fa-solid fa-thumbs-up"></i> <span id="like_span_<?php echo $result6['id']; ?>"></span>
                    </div>
                    <div id="comment_<?php echo $result6['id']; ?>" class="post__action">
                        <i class="fa-solid fa-comments"></i> <span id="comment_span_<?php echo $result6['id']; ?>">0</span>
                    </div>
                    <div id="share_<?php echo $result6['id']; ?>" class="post__action">
                        <i class="fa-solid fa-share-nodes"></i> <span>0</span>
                    </div>
                    <script>
                        $(document).ready(function(){
                            function loadLikes(){
                                $.ajax({
                                    url: "fetchLikes.php?id=<?php echo $result6['id']; ?>",
                                    type: "POST",
                                    success: function(data){
                                        $("#like_span_<?php echo $result6['id']; ?>").html(data);
                                    }
                                });
                            }
                            loadLikes();
                            $("#like_<?php echo $result6['id']; ?>").on("click", function(){
                                $.ajax({
                                    url: 'saveLike.php?id=<?php echo $result6['id']; ?>',
                                    type: 'POST',
                                    success: function(data){
                                        loadLikes();
                                    }
                                });
                            });
                            $("#share_<?php echo $result6['id']; ?>").on("click", function(){
                                alert("It is under construction");
                            });
                        });
                    </script>
                </div>
                <div class="comment__section" id="comment_section_<?php echo $result6['id']; ?>">
                    <div class="comment__input__box">
                        <input id="comment_desc_<?php echo $result6['id']; ?>" class="comment__input" type="text" placeholder="Place your comment" />
                        <input id="send_comment_<?php echo $result6['id']; ?>" class="comment__btn" type="submit" value="Send" />
                    </div>
                    <div class="comments">
                        <script>
                            $(document).ready(function(){
                                function loadComments(){
                                    $.ajax({
                                        url: "fetchComments.php?id=<?php echo $result6['id']; ?>",
                                        type: 'POST',
                                        success: function(data){
                                            var arr = data.split(",");
                                            $("#comment_span_<?php echo $result6['id']; ?>").html(arr[2]);
                                            $(".commenter_name").html(arr[0]);
                                        }
                                    });
                                }
                                loadComments();
                                $("#send_comment_<?php echo $result6['id']; ?>").on("click", function(){
                                    var comment = $("#comment_desc_<?php echo $result6['id']; ?>").val();
                                    $.ajax({
                                        url: "saveComment.php?id=<?php echo $result6['id']; ?>", 
                                        type: "POST",
                                        data: {comment},
                                        success: function(data){
                                            loadComments();
                                        }
                                    });
                                });
                                $("#comment_<?php echo $result6['id']; ?>").on("click", function(){
                                $("#comment_section_<?php echo $result6['id']; ?>").toggleClass("comment_active");
                                $("#comment_<?php echo $result6['id']; ?>").toggleClass("commentbtn_active");
                            });
                            });
                        </script>
                        <?php 
                            $sql5 = "SELECT * FROM comments WHERE post_id={$result6['id']}";
                            $query5 = mysqli_query($con, $sql5);
                            if(mysqli_num_rows($query5) > 0){
                                while($result5 = mysqli_fetch_assoc($query5)){ ?>
                        <div class="comment">
                            <img src="images.png" alt="" />
                            <div class="comment__info">
                                <h4 id="commenter_name_<?php echo $result6['id']; ?>"><?php echo $result5['commenter_name']; ?></h4>
                                <span id="comment_<?php echo $result6['id']; ?>"><?php echo $result5['comment']; ?></span>
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
    </div>

    <script src="main.js"></script>
</body>

</html>

<?php include "style.php"; ?>