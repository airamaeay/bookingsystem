<?php
    session_start();
    require "../config.php";
    if(!isset($_SESSION['consumers'])&&!isset($_SESSION['providers'])){
        header("location: ../");
        exit;
    }
    if(isset($_GET['id'])){
        $clean_id=clean($con,$_GET['id']);
    }else{
        header("location: ../");
        exit;
    }
    $result=mysqli_query($con,"SELECT 
        b.*,
        s.title,
        c.username consumer_name,
        c.id consumer_id,
        p.username provider_name,
        p.id provider_id
        FROM books b
    LEFT JOIN services s ON b.service=s.id
    LEFT JOIN consumers c ON b.consumer=c.id
    LEFT JOIN providers p ON s.provider=p.id
    WHERE b.id='$clean_id'");
    $data=mysqli_fetch_array($result,MYSQLI_ASSOC);
    if(isset($_SESSION['consumers'])){
        $consumer="You";
        $provider=$data['provider_name'];
    }else{
        $consumer=$data['consumer_name'];
        $provider="You";
    }
    if(isset($_POST['send-message'])){
        $clean_message=clean($con,$_POST['message']);
        $user_type="0";
        if(isset($_SESSION['consumers'])){
            if($_SESSION['consumers']['id']==$data['consumer_id']){
                $user_type="2";
            }
        }
        if(isset($_SESSION['providers'])){
            if($_SESSION['providers']['id']==$data['provider_id']){
                $user_type="1";
            }
        }
        if($user_type=="0"){
            header("location: ../");
            exit;
        }
        $book=$data['id'];
        $result=mysqli_query($con,"INSERT INTO messages (
            `user_type`,
            `message`,
            `book`,
            `created`
        ) VALUES (
            '$user_type',
            '$clean_message',
            '$book',
            NOW()
        )");
        if($result){
            header("location: messages.php?id=".$clean_id."#bottom");
            exit;
        }
    }
    if(isset($_GET['decline'])){
        $clean_message="[THIS BOOKING IS NOW DECLINED]";
        $result=mysqli_query($con,"UPDATE books SET approved=2 WHERE id='$clean_id'");
    }
    if(isset($_GET['accept'])){
        $clean_message="[THIS BOOKING IS NOW ACCEPTED]";
        $result=mysqli_query($con,"UPDATE books SET approved=1 WHERE id='$clean_id'");
    }
    
    if(isset($_GET['accept'])||isset($_GET['decline'])){
        $user_type="1";
        $book=$data['id'];
        $result=mysqli_query($con,"INSERT INTO messages (
            `user_type`,
            `message`,
            `book`,
            `created`
        ) VALUES (
            '$user_type',
            '$clean_message',
            '$book',
            NOW()
        )");
        if($result){
            header("location: messages.php?id=".$clean_id."#bottom");
            exit;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>
	<?php require "../components/bootstrap.php"; ?>
    <link rel="stylesheet" href="../resources/css/custom-services-messages.css" type="text/css">
</head>
<body bgcolor="#888">
    <?php require "../components/header.php";?>
    <?php
        $status="";
        if($data['approved']=="1"){
            $status="[ACCEPTED]";
        }
        if($data['approved']=="2"){
            $status="[SERVICE UNAVAILABLE]";
        }
    ?>
    <div class="message-body">
        <h2><?php echo $data['title'];?> <?php echo $status;?></h2>
        <div class="messages">
            <?php
            echo $consumer.": ".$data['message']."<br><span>".$data['created']."</span><br>";
            $book_id=$data['id'];
            $result=mysqli_query($con,"SELECT * FROM messages WHERE book='$book_id' ORDER BY created ASC");
            $messages=mysqli_fetch_all($result,MYSQLI_ASSOC);
            foreach($messages as $each){
                if($each['user_type']==1){
                    $sender=$provider;
                }else{
                    $sender=$consumer;
                }
                if($sender=="You"){
                    echo "<b>".$sender."</b>: ".$each['message']."<br><span>".$each['created']."</span><br>";
                }else{
                    echo $sender.": ".$each['message']."<br><span>".$each['created']."</span><br>";
                }
            }
            ?>
        </div>
        <div id="bottom"></div>
        <div class="refresh">
            <a href="messages.php?id=<?php echo $clean_id."&".time()*rand(5,15);?>#bottom">Refresh</a> &nbsp;&nbsp;
            <?php if(isset($_SESSION['providers'])&&$data['approved']=="0"){ ?>
            <a href="messages.php?id=<?php echo $clean_id."&".time()*rand(5,15);?>&decline#bottom">Decline Booking</a> &nbsp;&nbsp;
            <a href="messages.php?id=<?php echo $clean_id."&".time()*rand(5,15);?>&accept#bottom">Accept Booking</a>
            <?php } ?>
        </div>
        <div class="type-message">
            <form method="post">
                <textarea name="message" placeholder="Message..."></textarea>
                <input class="submit" type="submit" name="send-message" value="Send">
            </form>
        </div>
    </div>
</body>
</html>