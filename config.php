<?php
    $con = mysqli_connect(
        "localhost",                // host
        "root",                     // username
        "",                         // password
        "onlinebookingsystem_db"    // database name
    ) or die(mysqli_error());

        /*
    object(mysqli)#1 (18) 
    { 
        ["affected_rows"]=> int(-1) 
        ["client_info"]=> string(13) "mysqlnd 8.0.0" 
        ["client_version"]=> int(80000) 
        ["connect_errno"]=> int(0) 
        ["connect_error"]=> NULL 
        ["errno"]=> int(1062) 
        ["error"]=> string(41) "Duplicate entry 'aira' for key 'username'" 
        ["error_list"]=> array(1) { 
            [0]=> array(3) { 
                ["errno"]=> int(1062) 
                ["sqlstate"]=> string(5) "23000" 
                ["error"]=> string(41) "Duplicate entry 'aira' for key 'username'" 
            } 
        } 
        ["field_count"]=> int(0) 
        ["host_info"]=> string(20) "localhost via TCP/IP" 
        ["info"]=> NULL 
        ["insert_id"]=> int(0) 
        ["server_info"]=> string(21) "5.5.5-10.4.17-MariaDB" 
        ["server_version"]=> int(100417) 
        ["sqlstate"]=> string(5) "23000" 
        ["protocol_version"]=> int(10) 
        ["thread_id"]=> int(69) 
        ["warning_count"]=> int(0) 
    }*/