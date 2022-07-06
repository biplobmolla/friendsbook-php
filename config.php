<?php
    $con = mysqli_connect("localhost", "root", "", "social-media");
    $localhost = "http://localhost/projects/practise/Social-Media";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <script>
        var width = window.outerWidth;
        if(width <= 900){
            var DIV = document.createElement("div");
            DIV.innerHTML = "<h1 style='padding: 20px; text-align: center; font-size: 40px; margin-top: 20%; color: #fff;'>Please visit this website from a desktop or a laptop</h1>";
            DIV.style = "width: 100vw; height: 100vh; position: fixed; top: 0; left: 0; background: #111;";
            document.body.appendChild(DIV);
        }

    </script>
</body>
</html>