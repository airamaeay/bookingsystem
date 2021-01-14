<?php
    require "starter.php";
    $this_page="bookings";
    require "must-have-ticket.php";
    require "head.php";

    //current bookings
    $result = mysqli_query(
        $con,"SELECT 
            s.*,
            c.category service_category,
            b.created book_created,
            b.consumer consumer,
            b.modified book_modified,
            bs.status booking_status,
            bs.color booking_color,
            b.id booking_id
        FROM books b
        LEFT JOIN services s
            ON b.service=s.id
        LEFT JOIN categories c
            ON s.category=c.id
        LEFT JOIN booking_status bs
            ON b.status=bs.id
        WHERE b.consumer=".$user['id']." 
        ORDER BY b.created DESC"
    );
    $countBooking = $result->num_rows;
    if ($countBooking) {
        $booking_results = mysqli_fetch_all($result,MYSQLI_ASSOC);
        $booking_results_message = "You have a total of ".$countBooking." booking".($countBooking>1?'s':'')."!";
    }else{
        $booking_results_message = "You haven't book any service yet!";
    }
?>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php require "side-bar.php";?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php require "nav-bar.php";?>
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Bookings</h1>
                    </div>
                    <div class="row">
                        <div class="col-lg-8">
                            <?php
                                if(!$countBooking){
                                    echo $booking_results_message;
                                }else{
                                    // echo $booking_results_message;
                                    echo "<div class='my-3'></div>";
                                    foreach($booking_results as $each){
                            ?>
                                        <div class="card shadow mb-4">
                                            <div class="card-header py-3">
                                                <h6 class="m-0 font-weight-bold text-primary">
                                                    <?php echo ucfirst($each['service_category']); ?></h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="mb-1 mt-1">
                                                    <a href="booking.php?id=<?php echo $each['id']; ?>&inquiring_id=<?php echo $each['consumer']; ?>&booking_id=<?php echo $each['booking_id']; ?>">
                                                        <h4><?php echo $each['title']; ?></h4>
                                                    </a>
                                                    <span class="status badge badge-<?php echo $each['booking_color']; ?> mb-2">
                                                        <?php echo $each['booking_status']; ?>
                                                    </span>
                                                    <br>
                                                    <div>
                                                        <?php
                                                            echo 
                                                                substr($each['description'], 0, 120) . "...";
                                                        ?>
                                                    </div>
                                                    <div style="font-size:14px;color:#bbb;" class="mt-2">
                                                        Book submitted: <?php echo dateAndTime($each['modified']); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                            <?php
                                    }
                                }
                            ?>
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
</body>

</html>