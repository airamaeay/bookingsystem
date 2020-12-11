<?php
    require '../config.php';
    session_start();
    if(!isset($_SESSION['providers'])){
        header('location: login.php');
        exit;
    }

    //BASIC INFORMATION
    $provider_id=$_SESSION['providers']['id'];
    $result=mysqli_query($con,"SELECT 
        p.*,
        a.account_type type,
        c.category,
        c.photo
        FROM providers p 
    LEFT JOIN account_types a ON a.id=p.account_type 
    LEFT JOIN categories c ON c.id=p.primary_category_id 
    WHERE p.id='$provider_id'");
    $data=mysqli_fetch_array($result,MYSQLI_ASSOC);

    //SERVICES
    $result=mysqli_query($con,"SELECT * FROM services WHERE provider='$provider_id'");
    $services_data=mysqli_fetch_all($result,MYSQLI_ASSOC);
    $result=mysqli_query($con,"SELECT * FROM categories");
    $categories_data=mysqli_fetch_all($result,MYSQLI_ASSOC);

    $error_message="";
    $category="";
    $title="";
    $availability="";
    $details="";
    $status="";
    $provider=$provider_id;
    $time_from="";
    $time_to="";
    if(isset($_POST['create-service'])){
        $title=$_POST['title'];
        $details=$_POST['details'];
        $status=$_POST['available-right-now'];
        $provider=$provider_id;
        $time_from=$_POST['time-from'];
        $time_to=$_POST['time-to'];

        $clean_title=clean($con,$title);
        $clean_details=clean($con,$details);
        $clean_status=clean($con,$status);
        $clean_provider=$provider_id;
        $clean_time_from=clean($con,$time_from);
        $clean_time_to=clean($con,$time_to);

        if(isset($_POST['category'])){
            $category=$_POST['category'];
            $clean_category=clean($con,$_POST['category']);
            $category_ok=1;
        }else{
            $error_message="Please select a service category.";
        }
        if(isset($_POST['whole-day'])){
            $clean_whole_day=clean($con,$clean_whole_day);
            if($clean_whole_day=='1'){
                $availability="24 HOURS";
                $availability_ok=1;
            }
        }else{
            if($time_from!=""&&$time_to!=""){
                $availability=$time_from.'--'.$time_to;
                $availability_ok=1;
            }elseif($time_from!=""||$time_to!=""){
                $error_message="Time of availability incomplete.";
            }else{
                $error_message="Please set time of availability.";
            }
        }
        if($category_ok&&$availability_ok){
            $result=mysqli_query($con,"INSERT INTO services (
                `category`,
                `status`,
                `title`,
                `details`,
                `provider`,
                `availability`,
                `created`,
                `modified`
            ) VALUES (
                '$clean_category',
                '$clean_status',
                '$clean_title',
                '$clean_details',
                '$clean_provider',
                '$availability',
                NOW(),
                NOW()
            )");
            var_dump($con->error);
            var_dump($result);
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Document</title>
</head>
<body bgcolor="#888">
    <br><br>
    <a href="../logout.php?redirect=providers/login.php">Logout</a>
    <br><br>
    Username: <?php echo $data['username'];?>
    <br>
    Company Name: <?php echo $data['first_name'].' '.$data['last_name'];?>
    <br>
    Account Type: <?php echo $data['type'];?>
    <br>
    Phone Number: <?php echo $data['phone_number'];?>
    <br>
    Email: <?php echo $data['email'];?>
    <br>
    Primary Category: <?php echo $data['category'];?>
    <br>
    <br>
    Services:
    <br>
    <?php
        if(count($services_data)==0){
            echo "No services yet!";
        }
    ?>
    <br>
    <br>
    <div class="add-services">
        <h3>Add Service</h3>
        <p style="color:#800"><?php echo $error_message;?></p>
        <form method="post">
            <select name="category">
                <option disabled selected>Service Category</option>
                <?php
                    $selected="";
                    foreach($categories_data as $each){
                        if($category==$each['id']){
                            $selected=" selected";
                        }else{
                            $selected="";
                        }
                        echo 
                            "<option value='".$each['id']."' ".$selected.">".
                                $each['category']."
                            </option>";
                    }
                ?>
            </select>
            <br>
            <input name="title" placeholder="title" value="<?php echo $title;?>" required>
            <br>
            <br>
            Availability
            <br>
            <br>
            <input type="time" name="time-from" value="<?php echo $time_from;?>"> to <input type="time" name="time-to" value="<?php echo $time_to;?>">
            <br>
            <?php
                $checked="";
                if($availability=="24 HOURS"){
                    $checked="checked";
                }
            ?>
            <input type="checkbox" name="whole-day" value="1" <?php echo $checked;?>> Available 24 Hours
            <br>
            <br>
            <br>
            <textarea cols="30" rows="7" placeholder="details" name="details" required><?php echo $details;?></textarea>
            <br>
            <br>
            Available Right Now!
            <br>
            <input type="radio" name="available-right-now" value="1" required <?php if($status==0){echo "checked";}?>> Yes now!
            <br>
            <input type="radio" name="available-right-now" value="0" required <?php if($status==1){echo "checked";}?>> Will open soon...
            <br>
            <br>
            <input type="submit" name="create-service" value="Create Service">
        </form>
    </div>
</body>
</html>