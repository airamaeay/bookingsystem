<?php
    session_start();
    session_destroy();
    require "config.php";
    if(isset($_GET['redirect'])){
        $clean_redirect=clean($con,$_GET['redirect']);
        header("location: ".$_GET['redirect']);
    }else{
        header("location: ../");
    }
?>