<?php
	session_start();
	if(isset($_SESSION['consumers'])){
		header("location: dashboard.php");
		exit;
	}
	require "../config.php";
	
	$error_message="";
	$user_type="consumer";
	
	if(isset($_POST['submit-login'])){
		$user = $_POST['user'];
		$password = $_POST['password'];
		$result = mysqli_query($con,"SELECT * FROM consumers WHERE username='$user' AND password='$password'");
		$data = mysqli_fetch_array($result, MYSQLI_ASSOC);
		if($data==null){
			$error_message="Username and password didn't match.";
		}else{
			$_SESSION['consumers'] = array(
				'id'=>$data['id'],
				'user_type'=>$user_type
			);
			header("location: dashboard.php");
			exit;
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Consumers Login</title>
	<?php require "../components/bootstrap.php"; ?>
	<link href="<?php echo $resources; ?>/css/custom-consumers-login.css" rel="stylesheet" type="text/css" />
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
						<h3 class="text-dark">Consumers Login</h3>
						<p class="error-message"><?php echo $error_message; ?></p>
						<input type="text" class="form-control col-12" name="user" placeholder="username">
						<input type="password" class="form-control col-12" name="password" placeholder="password">
						<input type="submit" value="Login" class="form-control bg-dark text-white col-12" name="submit-login">
					</form>
					<div class="register">
						<a href="register.php">Register</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>