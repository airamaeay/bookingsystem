<?php
    session_start();
    if(!isset($_SESSION['consumers'])){
        header('location: login.php');
        exit;
    }
    var_dump($_SESSION['consumers']);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Document</title>
</head>
<body>
    <a href="../logout.php?redirect=consumers/login.php">Logout</a>
</body>
</html>