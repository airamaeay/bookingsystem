<?php
    require "config.php";
    if(isset($_POST['reg'])){
        $user = $_POST['user'];
        $pass = $_POST['pass'];
        $photo = $_POST['photo'];
        $success = mysqli_query(
            $con,
            "INSERT INTO users 
            (
                `username`,
                `password`,
                `picture`,
                `created`,
                `modified`
            ) VALUES (
                '$user',
                '$pass',
                '$photo',
                NOW(),
                NOW()
            )
            "
        );
        if($success){
            header("location: dashboard.php");
            exit;
        }else{
            echo $con->error;
        }
    }
?>
<form method="post">
    <input type="text" placeholder="username" required name="user">
    <input type="password" placeholder="password" required name="pass">
    <input type="text" placeholder="picture" required name="photo">
    <input type="submit" value="Register" name="reg">
</form>