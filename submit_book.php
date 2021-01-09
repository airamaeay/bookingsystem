<?php

    if(isset($_POST['book_now'])){
        echo "success";
        echo "<br>";
        echo $_POST['inquiring_id'];
        echo "<br>";
        echo $_POST['service_id'];
    }