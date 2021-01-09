<?php
    session_start();
    if(!isset($_SESSION['ticket'])){
        header("location: login.php");
    }
?>
<br>
dashboard page ito!
<br>
<br>
<a href="logout.php">logout</a>