<?php
    function genRan(){return rand((int)10000000,(int)99999999);}
    $random_numbers1 = genRan();
    $random_numbers2 = genRan();
    echo $random_numbers1;
    echo "<br>0";
    echo $random_numbers1;
    echo "<br>";
    echo "<br>";
    echo "<br>1";
    echo rand((int)10000000,(int)99999999);
    echo "<br>";
    echo "<br>";
    echo "<br>2";
    echo rand(10000000,99999999);