<?php
    session_start();
    include "config.php";
    if(isset($_POST['login'])){
        $user = $_POST['user'];
        $pass = $_POST['pass'];
        if(!empty($user)){
            if(!empty($pass)){
                $sql = "SELECT * FROM users WHERE email='{$user}' OR username='{$user}' OR number='{$user}'";
                $query = mysqli_query($con, $sql);
                if($query){
                    if(mysqli_num_rows($query)){
                        $result = mysqli_fetch_assoc($query);
                        if(($result['email'] == $user) || ($result['username'] == $user) || ($result['number'] == $user)){
                            if($result['password'] == $pass){
                                $_SESSION['user'] = $result['id'];
                                $_SESSION['name'] = $result['fname'] . " " . $result['lname'];
                                $_SESSION['active'] = null;
                                $_SESSION['request_get'] = false;
                                $_SESSION['get_id'] = "";
                                $_SESSION['f_id'] = "";
                                $_SESSION['fname'] = "";
                                $_SESSION['lname'] = "";
                                header("Location: index.php");
                            }
                        }
                    }
                }
            }
        }

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
    <link rel="stylesheet" href="style.css">
</head>

<body class="register__body">
    <form class="register__form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <h2 class="notification__top__title">Login Form</h2>
        <div class="register__input__field">
            <!-- <label class="register__label">Email</label> -->
            <input name="user" class="register__input" placeholder="Email or username or number" type="text" />
        </div>
        <div class="register__input__field">
            <!-- <label class="register__label">Email</label> -->
            <input name="pass" class="register__input" placeholder="Password" type="password" />
        </div>
        <div class="register__input__field login__btn">
            <input name="login" class="submit__btn" type="submit" />
        </div>
        <a class="regi_link" href="register.php">Register</a>
    </form>
    <script src="main.js"></script>
</body>

</html>

<?php include "style.php"; ?>