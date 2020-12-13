<?php
	session_start();
	if(isset($_SESSION['consumers'])){
		header("location: dashboard.php");
		exit;
	}
    require "../config.php";

    $error_message="";
    $user_type="consumer";

    $account_type="";
    $user="";
    $first_name="";
    $last_name="";
    $email="";
    $phone_number="";
    $primary_category_id="";

	if(isset($_POST['submit-login'])){
        $account_type=$_POST['account-type'];
        $first_name=$_POST['first-name'];
        $last_name=$_POST['last-name'];
        $email=$_POST['email'];
        $phone_number=$_POST['phone-number'];
        $primary_category_id=$_POST['primary-category-id'];
		$user = $_POST['user'];
		$password = $_POST['password'];
		$confirm_password = $_POST['confirm-password'];
		$result = mysqli_query($con,"SELECT * FROM consumers WHERE username='$user'");
		$data = mysqli_fetch_array($result, MYSQLI_ASSOC);
		if($data!=null){
            $error_message=$user." is already taken.";
		}else{
            if($password!=$confirm_password){
                $error_message="Passwords didn't match";
            }else{
                $result = mysqli_query($con,"SELECT * FROM user_types WHERE user_type='$user_type'");
                $data = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $user_type_id = $data['id'];
                $result = mysqli_query($con,"INSERT INTO consumers (
                    `username`,
                    `email`,
                    `password`,
                    `first_name`,
                    `last_name`,
                    `phone_number`,
                    `modified`,
                    `created`
                ) VALUES (
                    '$user',
                    '$email',
                    '$password',
                    '$first_name',
                    '$last_name',
                    '$phone_number',
                    NOW(),
                    NOW()
                )");
                $id=mysqli_insert_id($con);
                if($result){
                    session_destroy();
                    $_SESSION['consumers'] = array(
                        'id'=>$id,
                        'user_type'=>$user_type
                    );
                    header("location: dashboard.php");
                    exit;
                }
            }
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Consumers Register</title>
	<?php require "../components/bootstrap.php";?>
	<link href="<?php echo $resources; ?>/css/custom-consumers-register.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<div class="container-fluid page-container">
		<div class="row justify-content-center">
			<div class="col-xl-3 col-lg-5 col-md-6 col-sm-7 col-8">
				<div class="col-12 text-center">
					<a href="../">
						<img src="<?php echo $resources; ?>/images/homeserv.png">
					</a>
				</div>
				<div class="custom-form">
					<form method="post">
						<h3 class="text-dark">Consumers Register</h3>
						<p class="error-message"><?php echo $error_message;?></p>
						<input class="form-control col-12" name="first-name" value="<?php echo $first_name;?>" placeholder="First Name" required>
						<input class="form-control col-12" name="last-name" value="<?php echo $last_name;?>" placeholder="Last Name" required>
						<input type="email" class="form-control col-12" name="email" value="<?php echo $email;?>" placeholder="Email" required>
						<input class="form-control col-12" name="phone-number" value="<?php echo $phone_number;?>" placeholder="Phone Number" required>
						<input class="form-control col-12" name="user" placeholder="username"  value="<?php echo $user;?>" required>
						<input type="password" class="form-control col-12" name="password" placeholder="password" required>
                        <input type="password" class="form-control col-12" name="confirm-password" placeholder="confirm password" required>
						<input type="submit" value="Register" class="form-control bg-dark text-white col-12" name="submit-login">
					</form>
					<div class="login">
						<a href="login.php">Login</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>