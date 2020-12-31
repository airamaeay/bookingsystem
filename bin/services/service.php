<?php
    session_start();
    require "../config.php";
    if(isset($_GET["id"])){
        $clean_id=clean($con,$_GET['id']);
        $result=mysqli_query($con,"SELECT 
            s.*,
            p.company_name,
            p.account_type,
            p.first_name,
            p.last_name,
            p.phone_number,
            p.email
            FROM services s LEFT JOIN providers p ON p.id=s.provider WHERE s.id='$clean_id'");
        $data=mysqli_fetch_array($result,MYSQLI_ASSOC);
    }else{
        header("location: ../");
        exit;
    }

    if(isset($_SESSION['consumers'])){
        $consumer_id=$_SESSION['consumers']['id'];
    }
    $servce_id=$data['id'];
    $time_from="";
    $time_to="";
    $address="";
    $message="";
    if(isset($_POST['send-booking'])){
        if(!isset($_SESSION['consumers'])){
            header("location: ../consumers/login.php");
            exit;
        }
        $time_to=clean($con,$_POST['time-to']);
        $time_from=clean($con,$_POST['time-from']);
        $address=clean($con,$_POST['address']);
        $message=clean($con,$_POST['message']);
        $time=$time_from."--".$time_to;
        $result=mysqli_query($con,"INSERT INTO books (
            `consumer`,
            `service`,
            `message`,
            `time`,
            `address`,
            `approved`,
            `modified`,
            `created`
        ) VALUES (
            '$consumer_id',
            '$servce_id',
            '$message',
            '$time',
            '$address',
            '0',
            NOW(),
            NOW()
        )
        ");
        if($result){
            $servce_id=$data['id'];
            $time_from="";
            $time_to="";
            $time=$time_from."--".$time_to;
            $address="";
            $message="";

            $success_message="You have successfully sent a book for approval!";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service</title>
	<?php require "../components/bootstrap.php"; ?>
</head>
<body bgcolor="#777">
    <?php require "../components/header.php";?>
    <h3>Service</h3>
    <h1><?php echo $data['title'];?></h1>
    <?php
        if($data['status']=="0"){
            echo "<p>[ PLEASE BE PATIENT WHILE WE ARE PREPARING TO BE AVAILABLE SOON! THANK YOU! ]</p>";
        }
    ?>
    <p>Since: <?php echo $data['created'];?></p>
    <p>
        Service Provider: 
        <!-- <a href="../providers/provider?id=<?php echo $data['provider'];?>"> -->
            <?php
                if($data['account_type']=="1"){
                    echo $data['first_name']." ".$data['last_name'];
                }elseif($data['account_type']=="2"){
                    echo $data['company_name'];
                }
            ?>
        <!-- </a> -->
    </p>
    <p><?php echo $data['details'];?></p>
    <p>Availability: <?php 
        $from_to=explode("--",$data['availability']); //array('06:00','18:00')
        echo convert_to_normal_clock($from_to[0])." to ".convert_to_normal_clock($from_to[1]);
    ?></p>
    <p>Phone: <a href="tel:<?php echo $data['phone_number'];?>"><?php echo $data['phone_number'];?></a></p>
    <p>Email: <?php echo $data['email'];?></p>
    <br>
    <?php
        if($data['status']=="1"){
            ?>
    <form method="post">
        <h3>BOOK NOW!</h3>
        <p>This form is subject to approval.</p>
        SCHEDULE<br>
        <input type="time" name="time-to" value="<?php echo $time_to;?>" required> to <input type="time" name="time-from" value="<?php echo $time_from;?>" required>
        <br><br>
        <textarea name="address" cols="30" rows="5" placeholder="Exact Address"><?php echo $address;?></textarea>
        <br><br>
        <textarea name="message" cols="30" rows="10" placeholder="Message to Service Provider"><?php echo $message;?></textarea>
        <br><br>
        <input type="submit" name="send-booking" value="SEND">
    </form>
    <?php } ?>
</body>
</html>