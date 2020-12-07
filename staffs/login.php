<?php require "../config.php"; ?>
<?php
	$error_message="";
	if(isset($_POST['submit-login'])){
		$user = $_POST['user'];
		$password = $_POST['password'];
		$result = mysqli_query($con,"SELECT * FROM staffs WHERE username='$user' AND password='$password'");
		$fetched_data = mysqli_fetch_array($result, MYSQLI_ASSOC);
		if($fetched_data==null){
			$error_message="Username and password didn't match.";
		}else{
			header("location: dashboard.php");
		}
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
				<div class="col-12 text-center">
					<img src="../resources/images/logo.png">
				</div>
				<div class="custom-form">
					<form method="post">
						<h3 class="text-dark">Staffs Login</h3>
						<p class="error-message"><?php echo $error_message; ?></p>
						<input type="text" class="form-control col-12" name="username" placeholder="user">
						<input type="password" class="form-control col-12" name="password" placeholder="password">
						<input type="submit" class="form-control bg-dark text-white col-12" name="submit-login">
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>