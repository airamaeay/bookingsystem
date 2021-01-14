<?php
    $title = "Home Serv";
    $picture_dir = "users-pictures/";
    $category_picture_dir = "img/categories/";
    function sanitize($con,$input){
        $input = htmlspecialchars($input,ENT_QUOTES);
        return $con->real_escape_string($input);
    }
    function dateAndTime($string,$needs = "date"){
        $final_string = "";

        $date_time = explode(" ",$string);
        $cdate = $date_time[0];
        $time = $date_time[1];

        $year_month_date = explode("-",$cdate);
        $year = $year_month_date[0];
        $month = $year_month_date[1];
        $date = $year_month_date[2];

        $hours_minutes = explode(":",$time);
        $hours = $hours_minutes[0];
        $minutes = $hours_minutes[1];

        $months = array(
            "01"=>"January",
            "02"=>"February",
            "03"=>"March",
            "04"=>"April",
            "05"=>"May",
            "06"=>"June",
            "07"=>"July",
            "08"=>"August",
            "09"=>"September",
            "10"=>"October",
            "11"=>"November",
            "12"=>"December"
        );

        $AM = "AM";
        if($hours > 12){
            $hours = $hours - 12;
            $AM = "PM";
        }
        $time = $hours.":".$minutes." ".$AM;

        $final_string = $months[$month]." ".(int)$date.", ".$year;
        if($needs == "date"){
            return $final_string;
        }
        if($needs == "datetime"){
            return $final_string." ".$time;
        }
        if($needs == "time"){
            return $time;
        }
    }
    function checkFirst($message){
        $checker = "=======";
        $is_rate = strpos($message,$checker);
        if($is_rate !== false){
            $rate = explode($checker,$message);
            $count_stars = (int)$rate[0];
            $star_message = "";
            for($n = 0;$n < $count_stars; $n++){
                $star_message .= "<i class='fa fa-star text-warning'></i> ";
            }
            return $star_message;
        }else{
            $checker = "----------";
            $is_first = strpos($message,$checker);
            if($is_first !== false){
                $messages = explode($checker,$message);
                $message = $messages[0];
                $message2 = $messages[1];
                $message2_e = explode("-------",$message2);
                $message2_0 = explode("---",$message2_e[0]);
                $message2_1 = explode("---",$message2_e[1]);
                $message2_0_c = $message2_0[0]." ".$message2_0[1];
                $message2_1_c = $message2_1[0]." ".$message2_1[1];
                $datetime_from = dateAndTime($message2_0_c,"datetime");
                $datetime_to = dateAndTime($message2_1_c,"datetime");

                return $message."<br>From: ".$datetime_from."<br>To: ".$datetime_to;
            }else{
                return $message;
            }
                
        }
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
    function checkDefinition($definition,$page,$redirect = ''){
        $pages_for_providers = array(
            'services',
            'booking',
            'dashboard',
            'login',
            'create-service',
            'logout',
            'register'
        );
        $pages_for_consumers = array(
            'dashboard',
            'booking',
            'bookings',
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
