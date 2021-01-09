<?php
    $title = "Home Serv";
    $picture_dir = "users-pictures/";
    function sanitize($con,$input){
        return $con->real_escape_string($input);
    }

    function checkDefinition($definition,$page,$redirect = ''){
        $pages_for_providers = array(
            'services',
            'dashboard',
            'login',
            'logout',
            'register'
        );
        $pages_for_consumers = array(
            'dashboard',
            'login',
            'logout',
            'register'
        );
        if($redirect == "redirect"){
            if($definition == 1){
                if(!in_array($page, $pages_for_providers)){
                    header("location: index.php");
                    exit;
                }
            }
            if($definition == 2){
                if(!in_array($page, $pages_for_consumers)){
                    header("location: index.php");
                    exit;
                }
            }
        }else{
            if($definition == 1){
                if(in_array($page, $pages_for_providers)){
                    return 1;
                } else {
                    return 0;
                }
            }
            if($definition == 2){
                if(in_array($page, $pages_for_consumers)){
                    return 1;
                } else {
                    return 0;
                }
            }
        }
    }
