<?php
    session_start();
    if(!isset($_SESSION['staff'])){
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
    <a href="../logout.php?redirect=staffs/login.php">Logout</a>
</body>
</html>