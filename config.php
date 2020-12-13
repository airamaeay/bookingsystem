<?php
$host    = "localhost";
$db_name = "bookingsystem_db";
$db_user = "root";		
$db_pass = "";		
$con = mysqli_connect($host,$db_user,$db_pass,$db_name) or die(mysqli_error());	 
$resources = "../resources";
function clean($con,$input){
    return $con->real_escape_string($input);
}
function convert_to_normal_clock($time){
    $hours_minutes=explode(":",$time);
    $hours=$hours_minutes[0];
    $minutes=$hours_minutes[1];
    if(12<$hours){
        $time=($hours-12).":".$minutes;
        $AM_or_PM=" PM";
    }else{
        $time=($hours-0).":".$minutes;
        $AM_or_PM=" AM";
    }
    return $time.$AM_or_PM;
}
?>