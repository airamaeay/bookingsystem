<?php
    require "starter.php";
    $this_page="dashboard";
    $page_title="Search";
    require "must-have-ticket.php";
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

                        <div class="col-lg-6 mb-4">

                            <!-- Approach -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Search Results</h6>
                                </div>
                                <div class="card-body">
                                    <?php
                                        if(!$countSearch){
                                            echo $search_results_message;
                                        }else{
                                            echo $search_results_message;
                                            $increment = 0;
                                            echo "<div class='my-3'></div>";
                                            foreach($search_results as $each){
                                                $increment++;
                                    ?>
                                                <div class="mb-5 mt-1">
                                                    <a href="service.php?id=<?php echo $each['id']; ?>">
                                                        <h4><?php echo $increment.". ".$each['title']; ?></h4>
                                                    </a>
                                                    <p>
                                                        <?php
                                                            echo 
                                                                substr($each['description'], 0, 200) . "...";
                                                        ?>
                                                    </p>
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