<?php
    session_start();
    require "../config.php";
    if(!isset($_SESSION['consumers'])){
        header('location: login.php');
        exit;
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Document</title>
</head>
<body bgcolor="#888">
    <a href="../logout.php?redirect=consumers/login.php">Logout</a>
    <br>
    HISTORY
    <br>
    What service are you looking for?
    <form>
        <select onchange="this.form.submit()" name="search-category" required class="form-control">
            <option disabled selected>SELECT A CATEGORY</option>
            <?php
                $result = mysqli_query($con,"SELECT * FROM categories");
                $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
                foreach($data as $each){
                    $selected="";
                    echo '<option value="'.$each['id'].'"'.$selected.'>'.$each['category'].'</option>';
                }
            ?>
        </select>
    </form>
    <br><br>
    <?php
        if(isset($_GET['search-category'])){
            $clean_search_category=clean($con,$_GET['search-category']);
            $result=mysqli_query($con,"SELECT * FROM services WHERE category='$clean_search_category'");
            $services_data=mysqli_fetch_all($result,MYSQLI_ASSOC);
            foreach($services_data as $each){
                echo "<a href='../services/service.php?id=".$each["id"]."'>".$each["title"].
                "</a><br>".
                $each["details"]."<br><br>";
            }
        }
    ?>
</body>
</html>