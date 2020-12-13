<?php
	session_start();
	if(isset($_SESSION['staff'])){
		header("location: dashboard.php");
		exit;
	}
	require "../config.php";
	$error_message="";
	if(isset($_POST['submit-login'])){
		$user = $_POST['user'];
		$password = $_POST['password'];
		$result = mysqli_query($con,"SELECT * FROM staffs WHERE username='$user' AND password='$password'");
		$data = mysqli_fetch_array($result, MYSQLI_ASSOC);
		if($data==null){
			$error_message="Username and password didn't match.";
		}else{
			session_destroy();
			$_SESSION['staff'] = $data['username'];
			header("location: dashboard.php");
			exit;
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Staffs Login</title>
	<?php require "../components/bootstrap.php"; ?>
	<link href="<?php echo $resources; ?>/css/custom-staffs-login.css" rel="stylesheet" type="text/css" />
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
						<h3 class="text-dark">Staffs Login</h3>
						<p class="error-message"><?php echo $error_message; ?></p>
						<input type="text" class="form-control col-12" name="user" placeholder="username">
						<input type="password" class="form-control col-12" name="password" placeholder="password">
						<input type="submit" class="form-control bg-dark text-white col-12" name="submit-login" value="Login">
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>