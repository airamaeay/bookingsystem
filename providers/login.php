<?php
	session_start();
	if(isset($_SESSION['providers'])){
		header("location: dashboard.php");
		exit;
	}
	require "../config.php";
	$error_message="";
	if(isset($_POST['submit-login'])){
		$user = $_POST['user'];
		$password = $_POST['password'];
		$result = mysqli_query($con,"SELECT * FROM providers WHERE username='$user' AND password='$password'");
		$fetched_data = mysqli_fetch_array($result, MYSQLI_ASSOC);
		if($fetched_data==null){
			$error_message="Username and password didn't match.";
		}else{
			header("location: dashboard.php");
			$_SESSION['providers'] = $fetched_data['username'];
			exit;
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Providers Login</title>
	<?php require "../components/bootstrap.php"; ?>
	<link href="<?php echo $resources; ?>/css/custom-providers-login.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<div class="container-fluid page-container">
		<div class="row justify-content-center">
			<div class="col-xl-3 col-lg-3 col-md-4 col-sm-5 col-7">
				<div class="col-12 text-center">
					<img src="<?php echo $resources; ?>/images/logo.png">
				</div>
				<div class="custom-form">
					<form method="post">
						<h3 class="text-dark">Providers Login</h3>
						<p class="error-message"><?php echo $error_message; ?></p>
						<input type="text" class="form-control col-12" name="user" placeholder="username">
						<input type="password" class="form-control col-12" name="password" placeholder="password">
						<input type="submit" class="form-control bg-dark text-white col-12" name="submit-login">
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>