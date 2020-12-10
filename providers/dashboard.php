<?php
    session_start();
    if(!isset($_SESSION['providers'])){
        header('location: login.php');
        exit;
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Document</title>
</head>
<body>
    <a href="../logout.php?redirect=providers/login.php">Logout</a>
</body>
</html>