<?php
    $con = mysqli_connect(
        "localhost",                // host
        "root",                     // username
        "",                         // password
        "onlinebookingsystem_db"    // database name
    ) or die(mysqli_error());