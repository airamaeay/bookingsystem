<?php
	require "config.php";

	$error_message = "";
	if(isset($_POST['submit-login'])){
		$_user = $_POST['user'];
		$_password = $_POST['password'];
		$data = mysqli_query($con,"select * from staff where username='$_user'and password='$_password'");
		mysqli_fetch_array($data, MYSQLI_ASSOC);
		
	}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<link href="../resources/css/bootstrap.css" type="text/css" rel="stylesheet" />
	<script type="text/javascript" src="../resources/js/jquery.js"></script>
	<script type="text/javascript" src="../resources/js/bootstrap.js"></script>
	<link href="../resources/css/custom-staffs-login.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<div class="container-fluid page-container">
		<div class="row justify-content-center">
			<div class="col-xl-3 col-lg-3 col-md-4 col-sm-5 col-7">
				<img src="../resources/images/logo.png">
				<div class="custom-form">
					<form method="post">
						<h3 class="text-dark">Login</h3>
						<p class="error-message">
							<?php //echo $error_message; ?>	
						</p>
						<input type="text" class="form-control col-12" name="user" placeholder="user">
						<input type="password" class="form-control col-12" name="password" placeholder="password">
						<input type="submit" value="Sign In" class="form-control bg-dark text-white col-12" name="submit-login">
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>