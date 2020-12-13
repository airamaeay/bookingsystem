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
        $time_from=$_POST['time-from'];
        $time_to=$_POST['time-to'];

        $clean_title=clean($con,$title);
        $clean_details=clean($con,$details);
        $clean_status=clean($con,$status);
        $clean_time_from=clean($con,$time_from);
        $clean_time_to=clean($con,$time_to);

        $category_ok=0;
        if(isset($_POST['category'])){
            $category=$_POST['category'];
            $clean_category=clean($con,$_POST['category']);
            $category_ok=1;
        }else{
            $error_message="Please select a service category.";
        }
        $availability_ok=0;
        if(isset($_POST['whole-day'])){
            $clean_whole_day=clean($con,$_POST['whole-day']);
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
                '$provider',
                '$availability',
                NOW(),
                NOW()
            )");
            if($result){
                $category="";
                $title="";
                $availability="";
                $details="";
                $status="";
                $time_from="";
                $time_to="";
            }
        }
    }
    
    $edit_category="";
    $edit_title="";
    $edit_details="";
    $edit_availability="";
    $edit_time_from="";
    $edit_time_to="";
    $edit_status="";
    $edit_provider="";
    if(isset($_GET['edit-service'])){
        $service_id=clean($con,$_GET['edit-service']);
        //need ng provider id para hindi maedit ng ibang provider ang services ng iba
        $result=mysqli_query($con,"SELECT * FROM services WHERE id='$service_id' AND provider='$provider_id'");
        $edit_data=mysqli_fetch_array($result,MYSQLI_ASSOC);
        if($edit_data){
            $edit_category=$edit_data['category'];
            $edit_title=$edit_data['title'];
            $edit_details=$edit_data['details'];
            $edit_availability=$edit_data['availability'];
            if(strpos($edit_availability,'--')!==false){
                $edit_array_availability = explode("--",$edit_availability);
                $edit_time_from=$edit_array_availability[0];
                $edit_time_to=$edit_array_availability[1];
            }else{
                $edit_time_from="";
                $edit_time_to="";
            }
            $edit_status=$edit_data['status'];
            $edit_provider=$provider_id;
        }else{
            header("location: dashboard.php");
            exit;
        }
    }
    if(isset($_POST['save-edit'])){
        $title=$_POST['title'];
        $details=$_POST['details'];
        $status=$_POST['available-right-now'];
        $time_from=$_POST['time-from'];
        $time_to=$_POST['time-to'];

        $clean_title=clean($con,$title);
        $clean_details=clean($con,$details);
        $clean_status=clean($con,$status);
        $clean_time_from=clean($con,$time_from);
        $clean_time_to=clean($con,$time_to);

        $category_ok=0;
        if(isset($_POST['category'])){
            $category=$_POST['category'];
            $clean_category=clean($con,$_POST['category']);
            $category_ok=1;
        }else{
            $error_message="Please select a service category.";
        }

        $availability_ok=0;
        if(isset($_POST['whole-day'])){
            $clean_whole_day=clean($con,$_POST['whole-day']);
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
            $result=mysqli_query($con,"UPDATE services SET 
                `category`='$clean_category',
                `status`='$clean_status',
                `title`='$clean_title',
                `details`='$clean_details',
                `provider`='$provider',
                `availability`='$availability',
                `created`=NOW(),
                `modified`=NOW() WHERE id='$service_id' AND provider='$provider'
            ");
            if($result){
                header("location: dashboard.php?edit-successful=".$service_id);
                exit;
            }
        }
    }

    $display_note="none";
    $note="";
    if(isset($_GET['edit-successful'])){
        $service_id=clean($con,$_GET['edit-successful']);
        $result=mysqli_query($con,"SELECT * FROM services WHERE id='$service_id' AND provider='$provider'");
        $focus_data=mysqli_fetch_array($result,MYSQLI_ASSOC);
        $note=$focus_data['category']."<br>".
        $focus_data['status']."<br>".
        $focus_data['title']."<br>".
        $focus_data['details']."<br>".
        $focus_data['provider']."<br>".
        $focus_data['availability']."<br>".
        $focus_data['created']."<br>".
        $focus_data['modified']."<br>".
        "<a href='?edit-service=".$focus_data['id']."'>Edit</a>";
        $display_note="inline";
    }
    
    if(isset($_GET['service-unavailable'])){
        $book_id=clean($con,$_GET['service-unavailable']);
        $result=mysqli_query($con,"UPDATE books SET approved='2' WHERE id='$book_id'");
        if($result){
            header("location: dashboard.php");
            exit;
        }
    }

    $result=mysqli_query($con,"SELECT * FROM services WHERE provider='$provider_id'");
    $services_data=mysqli_fetch_all($result,MYSQLI_ASSOC);
    
?>
<!DOCTYPE html>
<html>
<head>
    <title>Document</title>
</head>
<body bgcolor="#888">

    <div class="note" style="display:<?php echo $display_note;?>">
        <?php echo $note; ?>
    </div>

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
    <br><br>
    <h4>Books for approval:</h4>
        <?php
            $result=mysqli_query($con,"SELECT b.*,c.username FROM books b 
            LEFT JOIN services s ON b.service=s.id
            LEFT JOIN consumers c ON b.consumer=c.id
            WHERE s.provider='$provider_id' AND b.approved='0'");
            $data=mysqli_fetch_all($result, MYSQLI_ASSOC);
            foreach($data as $each){
                $hour_minutes=explode("--",$each['time']);
                $time_to=convert_to_normal_clock($hour_minutes[0]);
                $time_from=convert_to_normal_clock($hour_minutes[1]);
                echo "<a href='../services/messages.php?id=".$each['id']."'>Reply</a><br>";
                echo "From: ".$each['username']."<br>";
                echo "Schedule: ".$time_to." to ".$time_from."<br>";
                echo "Address: ".$each['address']."<br>";
                echo "Message: ".$each['message']."<br>";
                echo "<a href='?service-unavailable=".$each['id']."'>Service Unavailable</a>";
                echo "<br><br><br><br>";
            }
        ?>
    <br><br><br>
    <h4>Services:</h4>
    <?php
        if(count($services_data)==0){
            echo "No services yet!";
        }else{
            foreach($services_data as $each){                
                echo $each['category']."<br>";
                echo $each['status']."<br>";
                echo $each['title']."<br>";
                echo $each['details']."<br>";
                echo $each['provider']."<br>";
                echo $each['availability']."<br>";
                echo $each['created']."<br>";
                echo $each['modified']."<br>";
                echo "<a href='?edit-service=".$each['id']."'>Edit</a><br><br>";
            }
        }
    ?>
    <br>
    <br>
    <div class="edit-services">
        <h3>Edit Service</h3>
        <p style="color:#800"><?php echo $error_message;?></p>
        <form method="post">
            <select name="category">
                <option disabled selected>Service Category</option>
                <?php
                    $selected="";
                    foreach($categories_data as $each){
                        if($edit_category==$each['id']){
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
            <input name="title" placeholder="title" value="<?php echo $edit_title;?>" required>
            <br>
            <br>
            Availability
            <br>
            <br>
            <input type="time" name="time-from" value="<?php echo $edit_time_from;?>"> to <input type="time" name="time-to" value="<?php echo $edit_time_to;?>">
            <br>
            <?php
                $edit_checked="";
                if($edit_availability=="24 HOURS"){
                    $edit_checked="checked";
                }
            ?>
            <input type="checkbox" name="whole-day" value="1" <?php echo $edit_checked;?>> Available 24 Hours
            <br>
            <br>
            <br>
            <textarea cols="30" rows="7" placeholder="details" name="details" required><?php echo $edit_details;?></textarea>
            <br>
            <br>
            Available Right Now!
            <br>
            <input type="radio" name="available-right-now" value="1" required <?php if($edit_status==1){echo "checked";}?>> Yes now!
            <br>
            <input type="radio" name="available-right-now" value="0" required <?php if($edit_status==0){echo "checked";}?>> Will open soon...
            <br>
            <br>
            <input type="submit" name="save-edit" value="Save">
        </form>
    </div>
    
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
            <input type="radio" name="available-right-now" value="1" required <?php if($status==1){echo "checked";}?>> Yes now!
            <br>
            <input type="radio" name="available-right-now" value="0" required <?php if($status==0){echo "checked";}?>> Will open soon...
            <br>
            <br>
            <input type="submit" name="create-service" value="Create Service">
        </form>
    </div>
</body>
</html>