<?php
    require "starter.php";
    $this_page="dashboard";
    $page_title="Message";
    require "must-have-ticket.php";
    if(isset($_GET['service_id']) && isset($_GET['inquiring_id']) && isset($_GET['booking_id'])){
        $booking_id = sanitize($con,$_GET['booking_id']);
        $json_booking_id = $booking_id;
        $service_id = sanitize($con,$_GET['service_id']);
        $inquiring_id = sanitize($con,$_GET['inquiring_id']);

        $result = mysqli_query($con,"SELECT * FROM books WHERE `id` = '$booking_id'");
        $book = mysqli_fetch_array($result,MYSQLI_ASSOC);
        // $book = $booking_id;
        if(!$book){
            header("location: booking.php?id=".$service_id."&inquiring_id=".$inquiring_id."&booking_id=".$booking_id);
            exit;
        }else{
            if($book['status']=='7'){
                header("location: booking.php?id=".$service_id."&inquiring_id=".$inquiring_id."&booking_id=".$booking_id);
                exit;
            }
        }

        if(isset($_POST['upgrade'])){
            $result = mysqli_query($con,"SELECT * FROM books WHERE id = '$booking_id'");
            $data = mysqli_fetch_array($result,MYSQLI_ASSOC);
            $new_status = $data['status'] + 1;
            if($new_status < 4){
                mysqli_query($con,"UPDATE books SET `status` = '$new_status' WHERE `id` = '$booking_id'");

                $book_id = $data['id'];
                $user_id = $user['id'];

                mysqli_query($con,
                    "INSERT INTO messages(
                        `message`,
                        `sender`,
                        `booking`,
                        `created`,
                        `modified`,
                        `status_update`
                    ) VALUES (
                        '$new_status',
                        '$user_id',
                        '$book_id',
                        NOW(),
                        NOW(),
                        '1'
                    )"
                );
            }
            header("location: message.php?service_id=".$service_id."&inquiring_id=".$inquiring_id."&booking_id=".$booking_id."#scroll-bottom");
            exit;
        }
        $result = mysqli_query($con,
            "SELECT 
                m.*,
                b.date_time_from_to,
                u.definition,
                um.picture,    
                um.online_status
            FROM messages m
                LEFT JOIN books b
                    ON m.booking = b.id
                LEFT JOIN services s
                    ON b.service = s.id
                LEFT JOIN users u
                    ON b.consumer = u.id
                LEFT JOIN users um
                    ON m.sender = um.id
            WHERE s.id = '$service_id' AND u.id = '$inquiring_id' AND b.id = '$booking_id'
        ");
        $messages = mysqli_fetch_all($result,MYSQLI_ASSOC);

        $result = mysqli_query($con,
            "SELECT * FROM services s
                LEFT JOIN books b
                    ON b.service = s.id
                LEFT JOIN categories c
                    ON c.id = s.category
            WHERE s.id = '$service_id'
        ");
        $service = mysqli_fetch_array($result,MYSQLI_ASSOC);
    }else{
        header("location: index.php");
        exit;
    }
    $book = "";
    $is_booked = false;
    $user_id = $user['id'];
    $result = mysqli_query(
        $con,
        "SELECT
            b.*,
            bs.status booking_status,
            bs.color booking_status_color,
            bs.action booking_status_action
        FROM books b 
        LEFT JOIN booking_status bs
            ON b.status = bs.id
        WHERE b.`id`='$booking_id'");
    $is_booked = $result->num_rows;
    $book = mysqli_fetch_array($result,MYSQLI_ASSOC);
    if($book['status']=='7'){
        header("location: booking.php?id=".$service_id."&inquiring_id=".$inquiring_id."&booking_id=".$booking_id);
        exit;
    }
    
    $book_id = $book['id'];
    if(isset($_POST['submit-rating'])){
        $rate = sanitize($con,$_POST['rate']);
        if($rate<1){
            $rate = 1;
        }
        mysqli_query($con,"UPDATE books SET rating = '$rate' WHERE id = '$book_id'");

        $given_rate = $rate."=======Service"; 
        mysqli_query($con,
            "INSERT INTO messages(
                `message`,
                `sender`,
                `booking`,
                `created`,
                `modified`
            ) VALUES (
                '$given_rate',
                '$user_id',
                '$book_id',
                NOW(),
                NOW()
            )"
        );
        header("location: message.php?service_id=".$service_id."&inquiring_id=".$inquiring_id."&booking_id=".$booking_id."#scroll-bottom");
        exit;
    }
    if(isset($_POST['submit-rating-consumer'])){
        $rate = sanitize($con,$_POST['rate-consumer']);
        if($rate<1){
            $rate = 1;
        }
        mysqli_query($con,"UPDATE books SET rating_to_consumer = '$rate' WHERE id = '$book_id'");
        $given_rate = $rate."=======Service"; 
        mysqli_query($con,
            "INSERT INTO messages (
                `message`,
                `sender`,
                `booking`,
                `created`,
                `modified`
            ) VALUES (
                '$given_rate',
                '$user_id',
                '$book_id',
                NOW(),
                NOW()
            )"
        );
        header("location: message.php?service_id=".$service_id."&inquiring_id=".$inquiring_id."&booking_id=".$booking_id."#scroll-bottom");
        exit;
    }
    if(isset($_POST['submit-report-consumer'])){
        $report_consumer = "report+++++++consumer";
        mysqli_query($con,
            "INSERT INTO messages (
                `message`,
                `sender`,
                `booking`,
                `created`,
                `modified`
            ) VALUES (
                '$report_consumer',
                '$user_id',
                '$book_id',
                NOW(),
                NOW()
            )"
        );
        mysqli_query($con,"UPDATE books SET `status`='7', rating_to_consumer = '-5' WHERE id = '$book_id'");
        header("location: message.php?service_id=".$service_id."&inquiring_id=".$inquiring_id."&booking_id=".$booking_id."#scroll-bottom");
        exit;
    }
    if(isset($_POST['submit-report'])){
        $report_provider = "report+++++++provider";
        mysqli_query($con,
            "INSERT INTO messages (
                `message`,
                `sender`,
                `booking`,
                `created`,
                `modified`
            ) VALUES (
                '$report_provider',
                '$user_id',
                '$book_id',
                NOW(),
                NOW()
            )"
        );
        mysqli_query($con,"UPDATE books SET `status`='7', rating = '-5' WHERE id = '$book_id'");
        header("location: message.php?service_id=".$service_id."&inquiring_id=".$inquiring_id."&booking_id=".$booking_id."#scroll-bottom");
        exit;
    }

    $result = mysqli_query($con,"SELECT * FROM booking_status");
    $booking_status_list = mysqli_fetch_all($result,MYSQLI_ASSOC);

    require "head.php";
?>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php require "side-bar.php";?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php require "nav-bar.php";?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">



                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-lg-10 mb-4">

                            <!-- Illustrations -->
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <!-- <div class="text-center">
                                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                                            src="img/undraw_posting_photo.svg" alt="">
                                    </div> -->
                                    <div class="chat-box" id="chat-box">
                                        <div class="row message-note">
                                            <div class="col text-center">
                                            <?php echo ucfirst($service['category']); ?>: 
                                            <a class="text-secondary" href="booking.php<?php echo "?id=".$service_id."&inquiring_id=".$inquiring_id;?>">
                                            <?php echo $service['title']; ?>
                                            </a>
                                            </div>
                                        </div>
                                        <?php
                                            $last_message_id = 0;
                                            foreach($messages as $each){
                                                $last_message_id = $each['id'];
                                                if($each['sender']!=$user['id']){
                                                    $sender = $each['id'];
                                                    mysqli_query($con,"UPDATE messages SET seen = 1 WHERE id = '$sender'");
                                                }
                                                if($each['status_update']){
                                        ?>
                                                    <div class="row message-note mt-3">
                                                        <div class="col text-center">
                                                            <?php
                                                                foreach($booking_status_list as $booking_status){
                                                                    if($booking_status['id']==$each['message']){
                                                            ?>
                                                                        <div class="status-lines"></div>
                                                                        <span
                                                                            class="badge-message-center badge badge-<?php echo $booking_status['color']; ?>"
                                                                        >
                                                                            <?php echo $booking_status['status']; ?>
                                                                        </span>
                                                                        <div class="message-date">
                                                                            <?php echo dateAndTime($each['created'],"datetime"); ?>
                                                                        </div>
                                                                        <div class="status-lines"></div>
                                                            <?php
                                                                    }
                                                                }
                                                            ?>
                                                        </div>
                                                    </div>
                                        <?php } else { ?>
                                                <?php
                                                    if(strpos($each['message'],"+++++++")){
                                                        $who_reported = ucfirst(explode("+++++++",$each['message'])[1])
                                                        ?>
                                                            <div class="row message-note mt-3">
                                                                <div class="col text-center">
                                                                    <div class="status-lines"></div>
                                                                    <span
                                                                        class="badge-message-center badge badge-danger"
                                                                    >
                                                                        <?php echo $who_reported; ?> Reported
                                                                    </span>
                                                                    <div class="message-date">
                                                                        <?php echo dateAndTime($each['created'],"datetime"); ?>
                                                                    </div>
                                                                    <div class="status-lines"></div>
                                                                </div>
                                                            </div>
                                                        <?php
                                                    }else{
                                                ?>
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="<?php echo ($each['sender']==$user['id'])?'right':'left'; ?> message-avatar-holder">
                                                                    <div
                                                                        class="user-avatar"
                                                                        style="background-image:url(<?php echo $picture_dir; ?><?php echo $each['picture']; ?>)"></div>
                                                                    <div class="status-indicator <?php echo ($each['online_status'])?'bg-success':'';?>"></div>
                                                                </div>
                                                                <div class="<?php echo ($each['sender']==$user['id'])?'right':'left'; ?>-message">
                                                                    <?php echo checkFirst($each['message']); ?>
                                                                    <div class="message-date <?php echo ($each['sender']==$user['id'])?'right':'left'; ?>">
                                                                        <?php echo dateAndTime($each['created'],"datetime"); ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                        <?php
                                                    }
                                                }
                                            }
                                        ?>
                                        <input type="text" id="composition-message" class="form-control input-message" placeholder="type message here">
                                        <div class="send-button" id="send-message"><i class="fa fa-paper-plane text-primary"></i></div>
                                    </div>
                            <div id="scroll-bottom">&nbsp;</div>
                                    <?php if($is_booked && $user['definition']=="2"){?>
                                    <div id="udpate-status">
                                        <div class="mt-1"></div>
                                        <span
                                            class="status badge-message-center badge badge-<?php echo $book['booking_status_color']; ?> mt-3"
                                        >
                                            <?php echo $book['booking_status']; ?>
                                        </span>
                                    </div>
                                    <?php }?>
                                    <?php
                                        if($user['definition']=="1"){
                                            if(!($book['status']>2)){
                                    ?>
                                                <div class="mt-3"></div>
                                                <form method="post" action="message.php?service_id=<?php echo $service_id;?>&inquiring_id=<?php echo $inquiring_id;?>&booking_id=<?php echo $json_booking_id;?>#scroll-bottom">
                                                    <button type="submit" name="upgrade" class="btn btn-<?php echo $book['booking_status_color']; ?> btn-sm">
                                                        <?php echo $book['booking_status_action']; ?>
                                                    </button>
                                                </form>
                                    <?php
                                            }else{
                                                // echo $book['booking_status_action'];
                                            }
                                            if($book['status']==3){
                                                ?>
                                                    <div class="mt-5">
                                                        Rate the Consumer!
                                                        &nbsp;
                                                        <form method="post">
                                                            <input id="rateHere" type="hidden" name="rate-consumer" value="">
                                                            <div style="font-size:27px;letter-spacing:3px;">
                                                                <i class="rating fa fa-star" r-value="1"></i>
                                                                <i class="rating fa fa-star" r-value="2"></i>
                                                                <i class="rating fa fa-star" r-value="3"></i>
                                                                <i class="rating fa fa-star" r-value="4"></i>
                                                                <i class="rating fa fa-star" r-value="5"></i>
                                                            </div>
                                                            <input type="submit" class="btn btn-primary mt-3" value="Submit Rating" name="submit-rating-consumer">
                                                            <div class="mt-3">
                                                            &nbsp;
                                                            </div>
                                                            <div class="mt-5">
                                                                Did you somehow find the consumer malicious?
                                                                <br>
                                                                By reporting, you will remove the stars you gave to the Consumer
                                                            </div>
                                                            <input type="submit" class="btn btn-danger mt-2" value="Report Consumer" name="submit-report-consumer">
                                                        </form>
                                                        <script>
                                                            $(".rating").each(function(){
                                                                $(this).click(function(){
                                                                    $("#rateHere").val($(this).attr("r-value"))
                                                                    $(".rating").removeClass("text-warning")
                                                                    var that = $(this)
                                                                    $(".rating").each(function(){
                                                                        var tvalue1 = parseInt($(this).attr("r-value"))
                                                                        var tvalue2 = parseInt(that.attr("r-value"))
                                                                        if(tvalue1<=tvalue2){
                                                                            $(this).addClass("text-warning")
                                                                        }
                                                                    })
                                                                })
                                                            })
                                                            $(".rating").each(function(){
                                                                var tvalue1 = parseInt($(this).attr("r-value"));
                                                                var tvalue2 = parseInt(<?php echo $book['rating_to_consumer']; ?>);
                                                                if(tvalue1<=tvalue2){
                                                                    $(this).addClass("text-warning")
                                                                }
                                                            })
                                                        </script>
                                                    </div>
                                                <?php
                                            }
                                        }else{
                                            if($book['status']==3){
                                                ?>
                                                    <div class="mt-5">
                                                        Rate the Service!
                                                        &nbsp;
                                                        <form method="post">
                                                            <input id="rateHere" type="hidden" name="rate" value="">
                                                            <div style="font-size:27px;letter-spacing:3px;">
                                                                <i class="rating fa fa-star" r-value="1"></i>
                                                                <i class="rating fa fa-star" r-value="2"></i>
                                                                <i class="rating fa fa-star" r-value="3"></i>
                                                                <i class="rating fa fa-star" r-value="4"></i>
                                                                <i class="rating fa fa-star" r-value="5"></i>
                                                            </div>
                                                            <input type="submit" class="btn btn-primary mt-3" value="Submit Rating" name="submit-rating">
                                                            <div class="mt-3">
                                                            &nbsp;
                                                            </div>
                                                            <div class="mt-5">
                                                                Did you somehow find this service malicious?
                                                                <br>
                                                                By reporting, you will remove the stars you gave to the Service Provider
                                                            </div>
                                                            <input type="submit" class="btn btn-danger mt-2" value="Report Service Provider" name="submit-report">
                                                        </form>
                                                        <script>
                                                            $(".rating").each(function(){
                                                                $(this).click(function(){
                                                                    $("#rateHere").val($(this).attr("r-value"))
                                                                    $(".rating").removeClass("text-warning")
                                                                    var that = $(this)
                                                                    $(".rating").each(function(){
                                                                        var tvalue1 = parseInt($(this).attr("r-value"))
                                                                        var tvalue2 = parseInt(that.attr("r-value"))
                                                                        if(tvalue1<=tvalue2){
                                                                            $(this).addClass("text-warning")
                                                                        }
                                                                    })
                                                                })
                                                            })
                                                            $(".rating").each(function(){
                                                                var tvalue1 = parseInt($(this).attr("r-value"));
                                                                var tvalue2 = parseInt(<?php echo $book['rating']; ?>);
                                                                if(tvalue1<=tvalue2){
                                                                    $(this).addClass("text-warning")
                                                                }
                                                            })
                                                        </script>
                                                    </div>
                                                <?php
                                            }
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php require "footer.php"; ?>
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <?php require "javascripts.php";?>
    <script>
        var to_refresh = 120;
        var last_id = <?php echo $last_message_id; ?>;
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let response = JSON.parse(this.responseText);
                if(response == "reported"){
                    location.reload();
                }
                for(var n=0;n<response.data.length;n++){
                    let left_right = (response.id == response.data[n].sender)?"right":"left";
                    last_id = response.data[n].message_id
                    if(response.data[n].status==3 && response.data[n].status_update=="1"){
                        location.reload();
                    }
                    if(response.data[n].status_update=="1"){
                        $("#chat-box").append(`
                        
                            <div class="row message-note mt-3">
                                <div class="col text-center">
                                    <div class="status-lines"></div>
                                        <span
        class="badge-message-center badge badge-`+response.data[n].bs_color+`"
                                            >
                                            `+response.data[n].bs_status+`
                                        </span>
                                        <div class="message-date">
                                            `+response.data[n].created+`
                                        </div>
                                        <div class="status-lines"></div>
                                </div>
                            </div>
                        `);
                        $("#udpate-status").html(`
                        
                            <div class="mt-1"></div>
                                <span
        class="status badge-message-center badge badge-`+response.data[n].bs_color+` mt-3"
                                >
                                `+response.data[n].bs_status+`
                            </span>
                        `);
                    } else {
                        var the_message = response.data[n].message
                        var star_message = the_message.includes("=======");
                        var stars = "";
                        console.log(response.data[n].user_picture)
                        var user_picture = response.data[n].user_picture
                        var online_status = response.data[n].online_status
                        var created = response.data[n].created
                        if(star_message){
                            var count_stars = the_message.split("=======")[0]
                            for(var n = 0; n < count_stars; n++ ){
                                stars += "<i class='fa fa-star text-warning'></i> "
                            }
                            the_message = stars
                        }
                        

                        var report = "";
                        var report_message = the_message.includes("+++++++");
                        if(report_message){
                            var reported2 = the_message.split("+++++++")[1]
                            
                            $("#chat-box").append(`
                                <div class="row message-note mt-3">
                                    <div class="col text-center">
                                        <div class="status-lines"></div>
                                            <span
                                                class="badge-message-center badge badge-danger"
                                                >
                                                `+reported2.charAt(0).toUpperCase() + reported2.slice(1) + ` Reported
                                            </span>
                                            <div class="message-date">
                                                `+response.data[n].created+`
                                            </div>
                                            <div class="status-lines"></div>
                                    </div>
                                </div>
                            `);
                        }else{
                            $("#chat-box").append(`
                                
                                <div class="row">
                                    <div class="col">
                                        <div class="`+left_right+` message-avatar-holder">
                                            <div
                                                class="user-avatar"
                                                style="background-image:url(<?php echo $picture_dir; ?>`+user_picture+`)"></div>
                                            <div class="status-indicator `+(online_status==1?'bg-success':'')+`"></div>
                                        </div>
                                        <div class="`+left_right+`-message">
                                            `+the_message+`
                                            <div class="message-date `+left_right+`">
                                                `+created+`
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `);
                        }
                    }
                }
            }
        };
        setInterval(() => {
            to_refresh -= 1
            xhttp.open("GET",
                "message-xhr.php?service_id=<?php echo $service_id; ?>&inquiring_id=<?php echo $inquiring_id; ?>&last_id="+last_id+"&booking_id=<?php echo $json_booking_id; ?>",
                true);
            xhttp.send();
            if(to_refresh == 0){
                window.location.reload()
            }
        }, 5000);
        function sendMessage(){
            let message = $("#composition-message").val();
            xhttp.open("GET", "message-xhr.php?"+
                "service_id=<?php echo $service_id; ?>&"+
                "inquiring_id=<?php echo $inquiring_id; ?>&"+
                "last_id="+last_id+"&"+
                "booking_id=<?php echo $json_booking_id; ?>&"+
                "message="+message,
            true);
            xhttp.send();
            $("#composition-message").val("");
        }
        $("#composition-message").on("keyup",function(e){
            if(e.keyCode==13){
                sendMessage();
            }
        });
        $("#send-message").click(function(){
            sendMessage();
        });
    </script>
</body>

</html>