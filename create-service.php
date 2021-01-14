<?php
    require "starter.php";
    $this_page="create-service";
    require "must-have-ticket.php";
    checkDefinition($user['definition'],'create-service','redirect');
    $error_message="";
    if(isset($_POST['new-service'])){
        $title = sanitize($con,$_POST['title']);
        $owner = $_SESSION['ticket']['id'];
        $description = sanitize($con,$_POST['description']);
        $category = sanitize($con,$_POST['category']);
        $availability = "";
        for($n = 0;$n < 1000; $n++){
            $three_dashes = "";
            if(isset($_POST['days'.$n])){
                $days = sanitize($con,$_POST['days'.$n]);
                $time_from = sanitize($con,$_POST['time_from'.$n]);
                $time_to = sanitize($con,$_POST['time_to'.$n]);
                $availability .= ($n>0?"---":"").$time_from."-".$time_to."--".$days;
            }
        }
        $success = mysqli_query(
            $con,
            "INSERT INTO services 
            (
                `title`,
                `owner`,
                `description`,
                `created`,
                `modified`,
                `category`,
                `availability`
            ) VALUES (
                '$title',
                '$owner',
                '$description',
                NOW(),
                NOW(),
                '$category',
                '$availability'
            )
            "
        ); 
        if($success){
            header("location: services.php");
            exit;
        }else{
            echo $con->error;
        }
    }

    $result = mysqli_query($con,"SELECT * FROM categories");
    $categories = mysqli_fetch_all($result,MYSQLI_ASSOC);

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
                        <div class="col-lg-6 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Create a Service</h6>
                                </div>
                                <div class="card-body">
                                <form method="post">
                                    <div class="form-group row" style="margin-bottom:30px;padding: 0px 12px;">
                                        <select name="category" class="form-control custom-select services-select">
                                            <option selected>Select your primary category</option>
                                            <?php
                                                foreach($categories as $each){
                                            ?>
                                                    <option value="<?php echo $each['id'];?>"><?php echo $each['category'];?></option>
                                            <?php
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <input class="form-control mb-3" name="title" placeholder='title' maxlength="100">
                                    <textarea class="form-control mb-3" name="description" cols="30" rows="10"></textarea>
                                    <div class="row-control-availability">
                                        <div class="control-availability" avail="0">
                                            <hr style="margin-top:25px">
                                            <div class="row">
                                                <input type="hidden" name="days0" id="selectedDays0">
                                                <div class="col-md-12 mb-1">Choose day and time of availability</div>
                                                <div class="col-md-12">
                                                    <div class="days">
                                                        <span id="week0" class="chooseWeek"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 timepick_inputs">
                                                    <input name="time_from0" class="timepicker0 form-control">
                                                </div>
                                                <div class="col-md-6">
                                                    <input name="time_to0" class="timepicker0 form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="add-control-availability btn btn-secondary my-3">
                                        <i class="fa fa-plus" style="font-size:14px;margin-right:2px"></i>
                                        Add Availability
                                    </div>
                                    <script>
                                        function runWeekAndTimePicker(id){
                                            $("#week"+id).weekLine({
                                                onChange: function () {
                                                    $("#selectedDays"+id).val(
                                                        $(this).weekLine('getSelected', 'indexes')
                                                    );
                                                }
                                            });
                                            $('.timepicker'+id).timepicker({
                                                timeFormat: 'h:mm p',
                                                interval: 30,
                                                minTime: '24',
                                                maxTime: '11:00pm',
                                                defaultTime: '6:00am',
                                                startTime: '6:00am',
                                                dynamic: true,
                                                dropdown: true,
                                                scrollbar: true
                                            });
                                        }
                                        var availability_form_counter = 0;
                                        $(".add-control-availability").click(function(){
                                            console.log("sdfsdf")
                                            let avail_old_id = availability_form_counter;
                                            let avail_new_id = avail_old_id + 1;
                                            availability_form_counter = avail_new_id;
                                            $(".row-control-availability").append(
                                                `
                                                    <div class="control-availability" avail="`+avail_new_id+`">
                                                        <hr style="margin-top:25px">
                                                        <div class="row">
                                                            <input type="hidden" name="days`+avail_new_id+`" id="selectedDays`+avail_new_id+`">
                                                            <div class="col-md-12 mb-1">Choose day and time of availability</div>
                                                            <div class="col-md-12">
                                                                <div class="days">
                                                                    <span id="week`+avail_new_id+`" class="chooseWeek"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 timepick_inputs">
                                                                <input name="time_from`+avail_new_id+`" class="timepicker`+avail_new_id+` form-control">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input name="time_to`+avail_new_id+`" class="timepicker`+avail_new_id+` form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                `
                                            );
                                            runWeekAndTimePicker(avail_new_id);
                                        });
                                        runWeekAndTimePicker(availability_form_counter);
                                    </script>
                                    <input class="form-control btn btn-primary" type="submit" value="Create Service" name="new-service">
                                </form>
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