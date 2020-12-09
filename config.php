<?php
$host    = "localhost";
$db_name = "bookingsystem_db";
$db_user = "root";		
$db_pass = "";		
$con = mysqli_connect($host,$db_user,$db_pass) or die(mysqli_error());
$con->set_charset("utf8");
         mysqli_select_db($con,$db_name) or die(mysqli_error());		 
?>