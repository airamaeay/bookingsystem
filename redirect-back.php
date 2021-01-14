<?php
    require "config.php";
    require "variable.php";
    if(isset($_GET['redirect'])){
        $redirect = sanitize($con,$_GET['redirect']);
        header("location: ".$redirect);
        exit;
    }