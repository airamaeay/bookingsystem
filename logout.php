<?php
    session_start();
    require "config.php";
    mysqli_query($con,"UPDATE users SET online_status = 0 WHERE id=".$_SESSION['ticket']['id']);
    session_destroy();
    header("location: login.php");