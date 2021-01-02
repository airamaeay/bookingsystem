<?php
    session_start();
    if(isset($_SESSION['ticket'])){
        header("location: dashboard.php");
    }
    require "config.php";
    if(isset($_POST['log'])){
        $user = $_POST['user'];
        $pass = $_POST['pass'];
        $success = mysqli_query(
            $con,
            "SELECT * FROM users
                WHERE 
                    `username`='$user' AND
                    `password`='$pass'
            "
        );
        if($success->num_rows){
            $_SESSION['ticket'] = "all rides!";
            header("location: dashboard.php");
            exit;
        }else{
            echo "Username password didn't match.";
        }
    }
?>
<form method="post">
    <input type="text" name="user" placeholder="username">
    <input type="password" name="pass" placeholder="password">
    <input type="submit" name="log" value="login">
</form>