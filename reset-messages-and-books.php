<?php
    require "config.php";
    mysqli_query($con,"UPDATE books SET `status` = 1, `rating` = '0', `rating_to_consumer` = '0'");
    mysqli_query($con,"DELETE FROM messages WHERE id > 42");