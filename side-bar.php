<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="services.php">
    <div class="sidebar-brand-icon rotate-n-15">
        <img src="img/homeserv.png" class="logo-side-bar">
    </div>
    <div class="sidebar-brand-text mx-3"><?php echo $title;?></div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<!-- <li class="nav-item <?php if($this_page=='dashboard'){echo 'active';}?>">
    <a class="nav-link" href="dashboard.php">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span>
    </a>
</li> -->
<?php
    if(checkDefinition($user['definition'],'services')){
?>
        <li class="nav-item <?php if($this_page=='services'){echo 'active';}?>">
            <a class="nav-link" href="services.php">
                <i class="fas fa-fw fa-tools"></i>
                <span>My Services</span>
            </a>
        </li>
<?php
    }
?>

<?php
    if(checkDefinition($user['definition'],'create-service')){
?>
        <li class="nav-item <?php if($this_page=='create-service'){echo 'active';}?>">
            <a class="nav-link" href="create-service.php">
                <i class="fas fa-fw fa-plus"></i>
                <span>Create Service</span>
            </a>
        </li>
<?php
    }
?>

<?php
    if(checkDefinition($user['definition'],'bookings')){
?>
        <li class="nav-item <?php if($this_page=='bookings'){echo 'active';}?>">
            <a class="nav-link" href="bookings.php">
                <i class="fas fa-fw fa-tools"></i>
                <span>Bookings</span>
            </a>
        </li>
<?php
    }
?>

<!-- <hr class="sidebar-divider">

<div class="sidebar-heading">
    Interface
</div>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Components</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Components:</h6>
            <a class="collapse-item" href="buttons.html">Buttons</a>
            <a class="collapse-item" href="cards.html">Cards</a>
        </div>
    </div>
</li> -->

<!-- Nav Item - Utilities Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
        aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-fw fa-list-alt"></i>
        <span>Categories</span>
    </a>
    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <!-- <h6 class="collapse-header">Custom Utilities:</h6> -->
            <?php
                $result = mysqli_query($con,"SELECT * FROM categories");
                $categories = mysqli_fetch_all($result,MYSQLI_ASSOC);
                foreach($categories as $each){
            ?>

                <a class="collapse-item" href="utilities-color.html"><?php echo ucfirst($each['category']); ?></a>

            <?php } ?>
        </div>
    </div>
</li>

    <!-- <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Addons
    </div> -->

<!-- <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
        aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-fw fa-folder"></i>
        <span>Pages</span>
    </a>
    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Login Screens:</h6>
            <a class="collapse-item" href="login.html">Login</a>
            <a class="collapse-item" href="register.html">Register</a>
            <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
            <div class="collapse-divider"></div>
            <h6 class="collapse-header">Other Pages:</h6>
            <a class="collapse-item" href="404.html">404 Page</a>
            <a class="collapse-item" href="blank.html">Blank Page</a>
        </div>
    </div>
</li>

<li class="nav-item">
    <a class="nav-link" href="charts.html">
        <i class="fas fa-fw fa-chart-area"></i>
        <span>Charts</span></a>
</li> -->

<!-- <li class="nav-item">
    <a class="nav-link" href="tables.html">
        <i class="fas fa-fw fa-table"></i>
        <span>Tables</span></a>
</li> -->

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

<!-- Sidebar Message -->
<!-- <div class="sidebar-card">
    <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="">
    <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
    <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
</div> -->

</ul>