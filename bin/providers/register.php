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
        $first_name=$_POST['first-name'];
        $last_name=$_POST['last-name'];
        $email=$_POST['email'];
        $phone_number=$_POST['phone-number'];
        $user = $_POST['user'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm-password'];
        if(isset($_POST['account-type'])){
            $account_type=$_POST['account-type'];
            if(isset($_POST['primary-category-id'])){
                $primary_category_id=$_POST['primary-category-id'];
                if($user!=""){
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
                                session_destroy();
                                session_start();
                                $_SESSION['providers'] = array(
                                    'id'=>$id,
                                    'user_type'=>$user_type
                                );
                                header("location: dashboard.php");
                                exit;
                            }
                        }
                    }
                }else{
                    $error_message="Please type a username.";
                }
            }else{
                $error_message="Please select your primary category.";
            }
        }else{
            $error_message="Please select an account type.";
        }
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Providers Register</title>
	<?php require "../components/bootstrap.php";?>
	<link href="<?php echo $resources; ?>/css/custom-providers-register.css" rel="stylesheet" type="text/css" />
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
						<h3 class="text-dark">Providers Register</h3>
						<p class="error-message"><?php echo $error_message; ?></p>
                        <div class="account-type">
                            <select class="form-control" name="account-type" required>
                                <option disabled selected>Account Type</option>
                                <?php
                                    $result = mysqli_query($con,"SELECT * FROM account_types");
                                    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
                                    foreach($data as $each){
                                        $selected="";
                                        if($account_type==$each['id']){
                                            $selected=" selected";
                                        }else{
                                            $selected="";
                                        }
                                        echo '<option value="'.$each['id'].'"'.$selected.'>'.$each['account_type'].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
						<input class="form-control col-12" name="first-name" value="<?php echo $first_name; ?>" placeholder="First Name" required>
						<input class="form-control col-12" name="last-name" value="<?php echo $last_name; ?>" placeholder="Last Name" required>
						<input type="email" class="form-control col-12" name="email" value="<?php echo $email; ?>" placeholder="Email" required>
						<input class="form-control col-12" name="phone-number" value="<?php echo $phone_number; ?>" placeholder="Phone Number" required>
                        <div class="primary-category">
                            <select class="form-control" name="primary-category-id" required>
                                <option disabled selected>Primary Category</option>
                                <?php
                                    $result = mysqli_query($con,"SELECT * FROM categories");
                                    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
                                    foreach($data as $each){
                                        $selected="";
                                        if($primary_category_id==$each['id']){
                                            $selected=" selected";
                                        }else{
                                            $selected="";
                                        }
                                        echo '<option value="'.$each['id'].'"'.$selected.'>'.$each['category'].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
						<input class="form-control col-12" name="user" value="<?php echo $user;?>" placeholder="username" required>
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