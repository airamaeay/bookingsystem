<?php
    require "starter.php";
    $this_page="service";
    $page_title="Service";
    require "must-have-ticket.php";

    if(isset($_GET['inquiring_id'])){
        $get_inquiring_id = sanitize($con,$_GET['inquiring_id']);
    }

    if(isset($_POST['book_now'])){
        $from_book_date = sanitize($con,$_POST['from_book_date']);
        $from_book_time = sanitize($con,$_POST['from_book_time']);
        $to_book_date = sanitize($con,$_POST['to_book_date']);
        $to_book_time = sanitize($con,$_POST['to_book_time']);
        $date_time_from_to = 
            $from_book_date."---".
            $from_book_time."-------".
            $to_book_date."---".
            $to_book_time;
        $book_message = sanitize($con,$_POST['book_message'])."----------".$date_time_from_to;
        $service_id = sanitize($con,$_POST['service_id']);
        $inquiring_id = sanitize($con,$_POST['inquiring_id']);
        $result = mysqli_query($con,
            "INSERT INTO books (
                `service`,
                `consumer`,
                `created`,
                `modified`,
                `date_time_from_to`
            ) VALUES (
                '$service_id',
                '$inquiring_id',
                NOW(),
                NOW(),
                '$date_time_from_to'
            )"
        );
        $book_id = mysqli_insert_id($con);
        $user_id = $user['id'];
        mysqli_query($con,
            "INSERT INTO messages(
                `message`,
                `sender`,
                `booking`,
                `created`,
                `modified`
            ) VALUES (
                '$book_message',
                '$user_id',
                '$book_id',
                NOW(),
                NOW()
            )"
        );
        mysqli_query($con,
            "INSERT INTO messages(
                `message`,
                `sender`,
                `booking`,
                `created`,
                `modified`,
                `status_update`
            ) VALUES (
                '1',
                '$user_id',
                '$book_id',
                NOW(),
                NOW(),
                '1'
            )"
        );
        header("location: booking.php?id=".$service_id."&inquiring_id=".$inquiring_id."&booking_id=".$book_id);
        exit;
    }

    if(isset($_GET['id'])){
        $id=sanitize($con,$_GET['id']);
        $result = mysqli_query($con,
            "SELECT 
                s.*,
                c.category service_category,
                c.picture picture,
                c.picture_position picture_position,
                u.first_name service_first_name,
                u.last_name service_last_name,
                u.email service_email,
                u.phone_number service_phone_number
            FROM services s
            JOIN categories c ON s.category=c.id
            JOIN users u ON s.owner=u.id
            WHERE s.id='$id'");
        $service = mysqli_fetch_array($result,MYSQLI_ASSOC);
        
        $avail = $service['availability'];
        $availabilities = [];
        $for_avail = explode("---",$service['availability']);
        for($n = 0;$n<count($for_avail);$n++){
            $new_array = explode("--",$for_avail[$n]);
            $time = $new_array[0];
            $days = $new_array[1];
            $new_array2 = explode("-",$time);
            $time_from = $new_array2[0];
            $time_to = $new_array2[1];
            array_push($availabilities,array(
                "days" => $days,
                "time_from" => $time_from,
                "time_to" => $time_to,
            ));
        }
    }else{
        header("location: index.php");
        exit;
    }
    if($user['definition']=='2'){
        $book = "";
        $is_booked = false;
        $user_id = $user['id'];
        $result = mysqli_query(
            $con,
            "SELECT
                b.*,
                bs.status booking_status,
                bs.color booking_status_color
            FROM books b 
            LEFT JOIN booking_status bs
                ON b.status = bs.id
            WHERE b.`service`='$id' AND b.consumer='$user_id'");
        $is_booked = $result->num_rows;
        if($is_booked){
            $book = mysqli_fetch_array($result,MYSQLI_ASSOC);
        }
    }
    if($user['definition']=='1'){
        $book = "";
        $is_booked = false;
        if(isset($_GET['inquiring_id'])){
            $user_id = sanitize($con,$_GET['inquiring_id']);
            $result = mysqli_query(
                $con,
                "SELECT
                b.*,
                bs.status booking_status,
                bs.color booking_status_color
            FROM books b 
            LEFT JOIN booking_status bs
                ON b.status = bs.id
            WHERE b.`service`='$id' AND b.consumer='$user_id'");
            $is_booked = $result->num_rows;
            if($is_booked){
                $book = mysqli_fetch_array($result,MYSQLI_ASSOC);
            }
        }
    }


    $is_booked = false;
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

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><?php echo $page_title; ?></h1>
                    </div>


                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-lg-10 mb-4">

                            <!-- Illustrations -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">
                                        <?php echo ucfirst($service['service_category']); ?>
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <!-- <div class="text-center">
                                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                                            src="img/undraw_posting_photo.svg" alt="">
                                    </div> -->
                                    <div class="bg-photo" style="
                                        <?php echo 
                                            'background:url(img/categories/'.$service['picture'].');'.
                                            'background-position:'.$service['picture_position']
                                            ; ?>
                                    "></div>
                                    <h1 style="font-size:24px;"><?php echo $service['title']; ?></h1>
                                    <div
                                        style="
                                            font-size:14px;
                                            margin-bottom:15px;
                                            color:#aaa;
                                        "
                                    >
                                        Posted by
                                        <?php echo $service['service_first_name']; ?>
                                        <?php echo $service['service_last_name']; ?>
                                    </div>

                                    <?php if($is_booked){
                                            if($book['status']!='7'){
                                        ?>
                                                <span
                                                    class="status badge-message-center badge badge-<?php echo $book['booking_status_color']; ?> mb-3"
                                                >
                                                    <?php echo $book['booking_status']; ?>
                                                </span>
                                    <?php
                                            }
                                        }
                                    ?>
                                    <p><?php echo $service['description']; ?></p>
                                    
                                    <div class="show-schedules mb-3">
                                        <b>Availability:</b>
                                        <?php
                                            // var_dump($availabilities);
                                            $days_of_week = [
                                                "Sunday",
                                                "Monday",
                                                "Tuesday",
                                                "Wednesday",
                                                "Thursday",
                                                "Friday",
                                                "Saturday"
                                            ];
                                            for($i = 0;$i < count($days_of_week); $i++){
                                                $day_available = 0;
                                                $day_showed_ticket = 1;
                                                for($n = 0;$n < count($availabilities); $n++){
                                                    $days_in_numbers = explode(",",$availabilities[$n]["days"]);
                                                    if(in_array($i."",$days_in_numbers)){
                                                        $day_available = 1;
                                        ?>
                                                        <div>
                                                            <div>
                                                                <?php
                                                                    echo $day_showed_ticket?$days_of_week[$i]:"&nbsp;";
                                                                ?>
                                                            </div>
                                                            <span>
                                                                <?php echo
                                                                    $availabilities[$n]["time_from"].
                                                                    " - ".
                                                                    $availabilities[$n]["time_to"];
                                                                ?>
                                                            </span>
                                                        </div>
                                        <?php
                                                        $day_showed_ticket = 0;
                                                    }
                                                }
                                                if(!$day_available){
                                        ?>
                                                
                                                    <div>
                                                        <div><?php echo $days_of_week[$i]; ?></div>
                                                        <i>unavailable</i>
                                                    </div>
                                        <?php
                                                }
                                            }
                                        ?>
                                        <div class="mt-4"></div>
                                        <b>Phone Number :</b>
                                        <a href="
                                            tel:<?php echo $service['service_phone_number']; ?>
                                        ">
                                            <?php echo $service['service_phone_number']; ?>
                                        </a>
                                        <br>
                                        <b>Email : </b>
                                        <a href="
                                            mailto:<?php echo $service['service_email']; ?>
                                        ">
                                            <?php echo $service['service_email']; ?>
                                        </a>
                                    </div>
                                        <?php if($user['definition']=="2"){ ?>
                                            <form id="scroll-bottom" method="post" action="service.php?id=<?php echo $id;?>&inquiring_id=<?php echo $user['id'];?>">
                                                <div class="row mb-3">
                                                    <div class="col-12">
                                                        <hr>
                                                        <h3>Book Now!</h3>
                                                        <b>Your Book Message</b>
                                                        <textarea class="form-control" name="book_message" style="height:150px" required></textarea>
                                                    </div>
                                                </div>
                                                <b>Date and Time</b>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        from
                                                        <input type="date" name="from_book_date" class="form-control mb-1" required>
                                                        <input type="time" name="from_book_time" class="form-control mb-1" required>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        to
                                                        <input type="date" name="to_book_date" class="form-control mb-1" required>
                                                        <input type="time" name="to_book_time" class="form-control mb-1" required>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="service_id" value="<?php echo $service['id']; ?>">
                                                <input type="hidden" name="inquiring_id" value="<?php echo $user['id']; ?>">
                                                <div class="mt-3">
                                                    <div class="mt-2 mb-1" style="font-size:14px;color:#aaa;margin-left:2px">
                                                        By booking, you agree to have a respectful conversation with the Service Provider as this is recorded.
                                                    </div>
                                                    <input type="submit" value="Book Now!" name="book_now" class="btn btn-danger">
                                                </div>
                                            </form>
                                        <?php } ?>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php require "footer.php"; ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
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
</body>

</html>