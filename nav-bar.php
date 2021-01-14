<?php
    $search_results_message = "";
    $search_results = [];
    $countSearch = 0;
    if(isset($_GET['search'])){
        $search = sanitize($con,$_GET['search']);
        $result = mysqli_query($con,"SELECT * FROM services WHERE title LIKE '%$search%' OR `description` LIKE '%$search%'");
        $countSearch = $result->num_rows;
        if ($countSearch) {
            $search_results = mysqli_fetch_all($result,MYSQLI_ASSOC);
            $search_results_message = $countSearch." result".($countSearch>1?'s':'')." found!";
        }else{
            $search_results_message = "No results was found!";
        }
        
    }
?>


<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
<!-- Sidebar Toggle (Topbar) -->
<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
</button>

<!-- Topbar Search -->
<form id="searchForm" method="get" action="search.php"
    class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
    <div class="input-group">
        <input id="searchBar" type="text" name="search" class="form-control bg-light border-0 small" placeholder="Search Services..."
            aria-label="Search" aria-describedby="basic-addon2">
        <div class="input-group-append">
            <button class="btn btn-primary" type="submit">
                <i class="fas fa-search fa-sm"></i>
            </button>
        </div>
    </div>
</form>

<script>
    $("#searchBar").on("change",function(){
        $("#searchForm").submit()
    });
</script>
<!-- Topbar Navbar -->
<ul class="navbar-nav ml-auto">

    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
    <li class="nav-item dropdown no-arrow d-sm-none">
        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-search fa-fw"></i>
        </a>
        <!-- Dropdown - Messages -->
        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
            aria-labelledby="searchDropdown">
            <form class="form-inline mr-auto w-100 navbar-search">
                <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small"
                        placeholder="Search for..." aria-label="Search"
                        aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </li>

    <!-- Nav Item - Alerts -->
    <!-- <li class="nav-item dropdown no-arrow mx-1"> -->
        <!-- <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-bell fa-fw"></i>
            <span class="badge badge-danger badge-counter">3+</span>
        </a> -->
        <!-- Dropdown - Alerts -->
        <!-- <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
            aria-labelledby="alertsDropdown">
            <h6 class="dropdown-header">
                Alerts Center
            </h6>
            <a class="dropdown-item d-flex align-items-center" href="#">
                <div class="mr-3">
                    <div class="icon-circle bg-primary">
                        <i class="fas fa-file-alt text-white"></i>
                    </div>
                </div>
                <div>
                    <div class="small text-gray-500">December 12, 2019</div>
                    <span class="font-weight-bold">A new monthly report is ready to download!</span>
                </div>
            </a>
            <a class="dropdown-item d-flex align-items-center" href="#">
                <div class="mr-3">
                    <div class="icon-circle bg-success">
                        <i class="fas fa-donate text-white"></i>
                    </div>
                </div>
                <div>
                    <div class="small text-gray-500">December 7, 2019</div>
                    $290.29 has been deposited into your account!
                </div>
            </a>
            <a class="dropdown-item d-flex align-items-center" href="#">
                <div class="mr-3">
                    <div class="icon-circle bg-warning">
                        <i class="fas fa-exclamation-triangle text-white"></i>
                    </div>
                </div>
                <div>
                    <div class="small text-gray-500">December 2, 2019</div>
                    Spending Alert: We've noticed unusually high spending for your account.
                </div>
            </a>
            <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
        </div> -->
    <!-- </li> -->

    <?php
        // if($user['definition']=="1"){
            $user_id = $user['id'];
            $result = mysqli_query($con,
                "SELECT 
                    b.id,
                    u.first_name,
                    u.last_name
                FROM books b
                    LEFT JOIN services s
                        ON b.service = s.id
                    LEFT JOIN users u
                        ON b.consumer = u.id
                WHERE s.owner = '$user_id' OR b.consumer = '$user_id'
            ");
            if($result){
                if($result->num_rows > 0){
                    $bookings = mysqli_fetch_all($result,MYSQLI_ASSOC);
                    $last_messages = array();
                    foreach($bookings as $each){
                        $booking_id = $each['id'];
                        $result = mysqli_query($con,
                            "SELECT
                                u.first_name,
                                u.last_name,
                                u.online_status,
                                u.id the_user_id,
                                m.*,
                                b.service,
                                b.consumer,
                                s.title service_title,
                                bs.color,
                                bs.status bs_status,
                                c.picture
                            FROM messages m
                                LEFT JOIN books b
                                    ON m.booking = b.id
                                LEFT JOIN booking_status bs
                                    ON b.status = bs.id
                                LEFT JOIN services s
                                    ON b.service = s.id
                                LEFT JOIN categories c
                                    ON s.category = c.id
                                LEFT JOIN users u
                                    ON b.consumer = u.id
                                WHERE m.booking = '$booking_id'
                                ORDER BY m.id DESC LIMIT 1");
                        $message = mysqli_fetch_array($result,MYSQLI_ASSOC);
                        array_push($last_messages,$message);
                    }
                }
            }
        // }
        if(isset($last_messages)){
            $seen = array();
            foreach($last_messages as $key => $row){
                $seen[$key] = $row['id'];
            }
            array_multisort($seen, SORT_DESC, $last_messages);
        }
    ?>
    <!-- Nav Item - Messages -->
    <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-envelope fa-fw"></i>
            <!-- Counter - Messages -->
            <?php
                $countNewMessages = 0;
                
                if(isset($last_messages)){
                    foreach($last_messages as $each){
                        if($each['seen']=='0' && $each['sender']!=$user['id']){
                            $countNewMessages += 1;
                        }
                    }
                }
            ?>
            <?php if($countNewMessages > 0){ ?>
                <span class="badge badge-danger badge-counter"><?php echo $countNewMessages; ?></span>
            <?php } ?>
        </a>
        <!-- Dropdown - Messages -->
        <div class="messages dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
            aria-labelledby="messagesDropdown">
            <h6 class="dropdown-header">
                Bookings
            </h6>
            <?php
                if(isset($last_messages)){
                    foreach($last_messages as $each){
                        $re_message = "";
                        if(strpos($each['message'],"=======")){
                            $re_message = "sent star(s)";
                        }else{
                            if(strpos($each['message'],"+++++++")){
                                $re_message = "has reported!";
                            }else{
                                $re_message = $each['message'];
                            }
                        }
            ?>
                        <a class="dropdown-item d-flex align-items-center" href="<?php
                            echo 
                                "message.php?".
                                "service_id=".$each['service'].
                                "&".
                                "inquiring_id=".$each['consumer'].
                                "&booking_id=".$each['booking']
                                ;
                        ?>">
                            <div class="dropdown-list-image mr-3">
                                <div
                                    class="user-avatar"
                                    style="background-image:url(<?php echo $category_picture_dir; ?><?php echo $each['picture']; ?>)"></div>
                                <!-- <div class="status-indicator <?php echo ($each['online_status'])?'bg-success':'';?>"></div> -->
                            </div>
                            <div class="<?php echo ($each['seen']==0 && $each['sender']!=$user['id'])?'font-weight-bold':''; ?>">
                                <div class="text-truncate"><?php echo substr(checkFirst($each['service_title']),0,40);?></div>
                                <div class="small text-gray-500">
                                    <?php 
                                        if($each['status_update']=="0"){
                                            $label_line = "";
                                            if($each['sender']==$user["id"]){
                                                $label_line .= "You: ";
                                            }else{
                                                $label_line .= $each['first_name'].": ";
                                            }
                                            $label_line .= checkFirst($re_message);
                                            echo substr($label_line,0,40);
                                        }
                                        if($each['status_update']=="1"){
                                            ?>
                                                <span
                                                    class="badge-message-center badge badge-<?php echo $each['color']; ?>"
                                                >
                                                    <?php echo $each['bs_status']; ?>
                                                </span>
                                            <?php
                                        }
                                    ?>

                                </div>
                            </div>
                        </a>
            <?php   
                    }
                }
            ?>
            <!-- <a class="dropdown-item d-flex align-items-center" href="#">
                <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="img/undraw_profile_1.svg"
                        alt="">
                    <div class="status-indicator bg-success"></div>
                </div>
                <div class="font-weight-bold">
                    <div class="text-truncate">Hi there! I am wondering if you can help me with a
                        problem I've been having.</div>
                    <div class="small text-gray-500">Emily Fowler · 58m</div>
                </div>
            </a>
            <a class="dropdown-item d-flex align-items-center" href="#">
                <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="img/undraw_profile_2.svg"
                        alt="">
                    <div class="status-indicator"></div>
                </div>
                <div>
                    <div class="text-truncate">I have the photos that you ordered last month, how
                        would you like them sent to you?</div>
                    <div class="small text-gray-500">Jae Chun · 1d</div>
                </div>
            </a>
            <a class="dropdown-item d-flex align-items-center" href="#">
                <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="img/undraw_profile_3.svg"
                        alt="">
                    <div class="status-indicator bg-warning"></div>
                </div>
                <div>
                    <div class="text-truncate">Last month's report looks great, I am very happy with
                        the progress so far, keep up the good work!</div>
                    <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                </div>
            </a>
            <a class="dropdown-item d-flex align-items-center" href="#">
                <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                        alt="">
                    <div class="status-indicator bg-success"></div>
                </div>
                <div>
                    <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                        told me that people say this to all dogs, even if they aren't good...</div>
                    <div class="small text-gray-500">Chicken the Dog · 2w</div>
                </div>
            </a> -->
            <!-- <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a> -->
        </div>
    </li>

    <div class="topbar-divider d-none d-sm-block"></div>

    <!-- Nav Item - User Information -->
    <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                <?php echo $user['first_name']; ?>
                <?php echo $user['last_name']; ?>
            </span>
            <div class="user-avatar" style="background-image:url(<?php echo $picture_dir; ?><?php echo $user['picture']; ?>)"></div>
            <!-- <img class="img-profile rounded-circle"
                src="<?php echo $picture_dir; ?><?php echo $user['picture']; ?>"> -->
        </a>
        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
            aria-labelledby="userDropdown">
            <!-- <a class="dropdown-item" href="#">
                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                Profile
            </a> -->
            <!-- <div class="dropdown-divider"></div> -->
            <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                Logout
            </a>
        </div>
    </li>

</ul>

</nav>
