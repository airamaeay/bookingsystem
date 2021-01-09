<?php
    require "starter.php";
    $this_page="dashboard";
    $page_title="Service";
    require "must-have-ticket.php";
    require "head.php";

    if(isset($_POST['book_now'])){
        $service_id = sanitize($con,$_POST['service_id']);
        $inquiring_id = sanitize($con,$_POST['inquiring_id']);
        $result = mysqli_query($con,
            "INSERT INTO books (
                `service`,
                `consumer`,
                `created`,
                `modified`
            ) VALUES (
                '$service_id',
                '$inquiring_id',
                NOW(),
                NOW()
            )");
        if($result){
            header("location: service.php?id=".$service_id);
            exit;
        }
    }

    if(isset($_GET['id'])){
        $id=sanitize($con,$_GET['id']);
        $result = mysqli_query($con,
            "SELECT 
                s.*,
                c.category service_category,
                u.first_name service_first_name,
                u.last_name service_last_name,
                u.email service_email,
                u.phone_number service_phone_number
            FROM services s
            JOIN categories c ON s.category=c.id
            JOIN users u ON s.owner=u.id
            WHERE s.id='$id'");
        $service = mysqli_fetch_array($result,MYSQLI_ASSOC);
    }else{
        header("location: index.php");
        exit;
    }

    $is_booked = false;
    $user_id = $user['id'];
    $result = mysqli_query($con,"SELECT * FROM books WHERE `service`='$id' AND consumer='$user_id'");
    $is_booked = $result->num_rows;
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
                                        <?php if($is_booked){?>
                                            <span class="badge badge-success ml-2">You have booked this service!</span>
                                        <?php }?>
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="text-center">
                                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                                            src="img/undraw_posting_photo.svg" alt="">
                                    </div>
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
                                    <p><?php
                                            $avail = $service['availability'];
                                            $time = (explode("--",$avail))[0];
                                            $days = (explode("--",$avail))[1];
                                            $time_from = (explode("-",$time))[0];
                                            $time_to = (explode("-",$time))[1];
                                            echo $days." ".$time_from. " to ".$time_to;
                                        ?>
                                    </p>
                                    <p><?php echo $service['description']; ?></p>
                                    <p>
                                        Phone Number :
                                        <a href="
                                            tel:<?php echo $service['service_phone_number']; ?>
                                        ">
                                            <?php echo $service['service_phone_number']; ?>
                                        </a>
                                        <br>
                                        Email : 
                                        <a href="
                                            mailto:<?php echo $service['service_email']; ?>
                                        ">
                                            <?php echo $service['service_email']; ?>
                                        </a>
                                    </p>
                                    <p>
                                        <?php if(!$is_booked){?>
                                            <form method="post" action="service.php?id=<?php echo $id;?>">
                                                <input type="hidden" name="service_id" value="<?php echo $service['id']; ?>">
                                                <input type="hidden" name="inquiring_id" value="<?php echo $user['id']; ?>">
                                                <input type="submit" value="Book Now!" name="book_now" class="btn btn-danger">
                                            </form>
                                        <?php }else{ ?>
                                            <a class="btn btn-primary" href="
                                                <?php
                                                    echo 
                                                        "messages.php?".
                                                        "service_id=".$service['id'].
                                                        "&".
                                                        "inquiring_id=".$user['id'];
                                                ?>
                                            ">
                                                Messages
                                            </a>
                                        <?php } ?>
                                    </p>
                                </div>
                            </div>


                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
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