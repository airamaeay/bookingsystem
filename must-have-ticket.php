<?php
    if(!isset($_SESSION['ticket'])){
        header("location: login.php");
        exit;
    } else {
        $user = $_SESSION['ticket'];
    }