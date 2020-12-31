<?php
  if(!isset($active_tab)){
    $active_tab="";
  }
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="../"><img class="logo" src="../resources/images/homeserv.png"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item <?php if($active_tab=='home'){echo 'active';};?>">
        <a class="nav-link" href="../">Home</a>
      </li>
      <li class="nav-item <?php if($active_tab=='dashboard'){echo 'active';};?>">
        <?php 
          $link="";
          if(isset($_SESSION['consumers'])){
            $link="consumers";
          }elseif(isset($_SESSION['providers'])){
            $link="providers";
          }else{
            $link="staffs";
          }
        ?>
        <a class="nav-link" href="../<?php echo $link;?>/dashboard.php">Dashboard</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../logout.php?redirect=<?php echo $link;?>/login.php">Logout</a>
      </li>
    </ul>
  </div>
</nav>