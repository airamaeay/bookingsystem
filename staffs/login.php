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
		$fetched_data = mysqli_fetch_array($result, MYSQLI_ASSOC);
		if($fetched_data==null){
			$error_message="Username and password didn't match.";
		}else{
			header("location: dashboard.php");
			$_SESSION['staff'] = $fetched_data['username'];
			exit;
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
<<<<<<< HEAD
	<title>Dashboard</title>
	<link href="../resources/css/bootstrap.css" type="text/css" rel="stylesheet" />
	<script type="text/javascript" src="../resources/js/jquery.js"></script>
	<script type="text/javascript" src="../resources/js/bootstrap.js"></script>
	<link href="../sssresources/css/custom-staffs-login.css" rel="stylesheet" type="text/css" />
=======
	<title>Staffs Login</title>
	<?php require "../components/bootstrap.php"; ?>
	<link href="<?php echo $resources; ?>/css/custom-staffs-login.css" rel="stylesheet" type="text/css" />
>>>>>>> 2e72ed0cad2f144e52c2545116933ccdb4dffe6d
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
<<<<<<< HEAD
						<h3 class="text-dark">Login</h3>
						<p class="error-message">
							<?php echo $error_message; ?>	
						</p>
						<input type="text" class="form-control col-12" name="user" placeholder="user">
=======
						<h3 class="text-dark">Staffs Login</h3>
						<p class="error-message"><?php echo $error_message; ?></p>
						<input type="text" class="form-control col-12" name="user" placeholder="username">
>>>>>>> 2e72ed0cad2f144e52c2545116933ccdb4dffe6d
						<input type="password" class="form-control col-12" name="password" placeholder="password">
						<input type="submit" value="Sign In" class="form-control bg-dark text-white col-12" name="submit-login">
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>