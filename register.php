<?php
    include "config.php";
    if(isset($_POST['submit'])){
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        if($_POST['username']){
            $username = $_POST['username'];
        }else{
            $username = "";
        }
        if($_POST['number']){
            $number = $_POST['number'];
        }else{
            $number = "";
        }
        $pass = $_POST['pass'];
        $cpass = $_POST['cpass'];

        if(!empty($fname)){
            if(!empty($lname)){
                if(!empty($email)){
                    if(!empty($pass)){
                        if(!empty($cpass)){
                            if($pass === $cpass){
                                $sql = "INSERT INTO users (fname, lname, email, username, number, password) VALUES ('{$fname}', '{$lname}', '{$email}', '{$username}', '{$number}', '{$pass}')";
                                $query = mysqli_query($con, $sql);
                                if($query){
                                    header("location: login.php");
                                }
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
    <form class="register__form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
        <h2 class="notification__top__title">Registration Form</h2>
        <div class="register__input__field">
            <!-- <label class="register__label">Name</label> -->
            <input name="fname" class="register__input" placeholder="First name" type="text" />
        </div>
        <div class="register__input__field">
            <!-- <label class="register__label">Name</label> -->
            <input name="lname" class="register__input" placeholder="Last name" type="text" />
        </div>
        <div class="register__input__field">
            <!-- <label class="register__label">Email</label> -->
            <input name="email" class="register__input" placeholder="Email" type="text" />
        </div>
        <div class="register__input__field">
            <!-- <label class="register__label">Email</label> -->
            <input name="username" class="register__input" placeholder="Username (optional)" type="text" />
        </div>
        <div class="register__input__field">
            <!-- <label class="register__label">Email</label> -->
            <input name="number" class="register__input" placeholder="Number (optional)" type="text" />
        </div>
        <div class="register__input__field">
            <!-- <label class="register__label">Email</label> -->
            <input name="pass" class="register__input" placeholder="Password" type="password" />
        </div>
        <div class="register__input__field">
            <!-- <label class="register__label">Email</label> -->
            <input name="cpass" class="register__input" placeholder="Confirm password" type="password" />
        </div>
        <div class="register__input__field login__btn">
            <input name="submit" class="submit__btn" type="submit" />
        </div>
        <a class="regi_link" href="login.php">Login</a>
    </form>
    <script src="main.js"></script>
</body>

</html>

<?php include "style.php"; ?>