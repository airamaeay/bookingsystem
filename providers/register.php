<?php
	session_start();
	if(isset($_SESSION['providers'])){
		header("location: dashboard.php");
		exit;
	}
    require "../config.php";
    
    $error_message="";
    $user_type="provider";

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
		$result = mysqli_query($con,"SELECT * FROM providers WHERE username='$user'");
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
                $result = mysqli_query($con,"INSERT INTO providers (
                    `account_type`,
                    `username`,
                    `email`,
                    `password`,
                    `first_name`,
                    `last_name`,
                    `phone_number`,
                    `primary_category_id`,
                    `modified`,
                    `created`
                ) VALUES (
                    '$account_type',
                    '$user',
                    '$email',
                    '$password',
                    '$first_name',
                    '$last_name',
                    '$phone_number',
                    '$primary_category_id',
                    NOW(),
                    NOW()
                )");
                $id=mysqli_insert_id($con);
                if($result){
                    $_SESSION['providers'] = array(
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
	<title>Providers Login</title>
	<?php require "../components/bootstrap.php";?>
	<link href="<?php echo $resources; ?>/css/custom-providers-register.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<div class="container-fluid page-container">
		<div class="row justify-content-center">
			<div class="col-xl-3 col-lg-5 col-md-6 col-sm-7 col-8">
				<div class="col-12 text-center">
					<img src="<?php echo $resources;?>/images/logo.png">
				</div>
				<div class="custom-form">
					<form method="post">
						<h3 class="text-dark">Providers Register</h3>
                        <div class="account-type">
                            <label>Account Type</label>
                            <select name="account-type">
                                <?php
                                    $result = mysqli_query($con,"SELECT * FROM account_types");
                                    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
                                    foreach($data as $each){
                                        $selected="";
                                        if($account_type==$each['id']){
                                            $selected=" selected";
                                        }
                                        echo '<option value="'.$each['id'].'"'.$selected.'>'.$each['account_type'].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
						<p class="error-message"><?php echo $error_message; ?></p>
						<input class="form-control col-12" name="first-name" value="<?php echo $first_name; ?>" placeholder="First Name">
						<input class="form-control col-12" name="last-name" value="<?php echo $last_name; ?>" placeholder="Last Name">
						<input type="email" class="form-control col-12" name="email" value="<?php echo $email; ?>" placeholder="Email">
						<input class="form-control col-12" name="phone-number" value="<?php echo $phone_number; ?>" placeholder="Phone Number">
                        <div class="primary-category">
                            <label>Primary Category</label>
                            <select name="primary-category-id">
                                <?php
                                    $result = mysqli_query($con,"SELECT * FROM categories");
                                    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
                                    foreach($data as $each){
                                        $selected="";
                                        if($primary_category_id==$each['id']){
                                            $selected=" selected";
                                        }
                                        echo '<option value="'.$each['id'].'"'.$selected.'>'.$each['category'].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
						<input class="form-control col-12" name="user" placeholder="username">
						<input type="password" class="form-control col-12" name="password" placeholder="password">
                        <input type="password" class="form-control col-12" name="confirm-password" placeholder="confirm password">
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