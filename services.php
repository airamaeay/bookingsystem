<?php
    require "starter.php";
    $this_page="services";
    require "must-have-ticket.php";
    $error_message="";
    if(isset($_GET['id'])){
        $id = sanitize($con,$_GET['id']);
        // $result = mysqli_query($con,"SELECT * FROM services WHERE `owner` = '$id'");
        // $service = mysqli_fetch_all($result,MYSQLI_ASSOC);
        
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
            WHERE s.owner='$id'");
        $services = mysqli_fetch_all($result,MYSQLI_ASSOC);
        
        if($result->num_rows == 0){
            $error_message = "No services yet!";
        }
    }else{
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
            JOIN users u ON s.owner=u.id LIMIT 100");
        $services = mysqli_fetch_all($result,MYSQLI_ASSOC);
    }
?>
<?php require "head.php"; ?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php require "side-bar.php"; ?>
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

                        <!-- Content Column -->
                        <div class="col-lg-10 mb-4">
                            <?php 
                                if($error_message!=""){
                                    echo $error_message;
                                }
                                foreach($services as $service){
                                    
        $availabilities = [];
        $for_avail = explode("---",$service['availability']);
        for($n = 0;$n<count($for_avail);$n++){
            $time = (explode("--",$for_avail[$n]))[0];
            $days = (explode("--",$for_avail[$n]))[1];
            $time_from = (explode("-",$time))[0];
            $time_to = (explode("-",$time))[1];
            array_push($availabilities,array(
                "days" => $days,
                "time_from" => $time_from,
                "time_to" => $time_to,
            ));
        }
                                    ?>
                            <!-- Project Card Example -->
                <div class="container-fluid">


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
                <h1 style="font-size:24px;">
                    <a href="service.php?id=<?php echo $service['id']; ?>">
                    <?php echo $service['title']; ?>
                    </a>
                </h1>
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
            </div>
        </div>
    </div>
                            <?php } ?>
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