<?php
    require "starter.php";
    if(isset($_SESSION['ticket'])){
        header("location: dashboard.php");
        exit;
    }
    $error_message="";
    if(isset($_POST['log'])){
        $user = $_POST['user'];
        $pass = $_POST['pass'];
        $success = mysqli_query(
            $con,
            "SELECT * FROM users
                WHERE 
                    `username`='$user' AND
                    `password`='$pass'
            "
        );
        if($success->num_rows){
            $user = mysqli_fetch_array($success,MYSQLI_ASSOC);
                
            $_SESSION['ticket'] = array(
                "id"=>$user['id'],
                "username" => $user['username'],
                "picture" => $user['picture'],
                "created" => $user['created'],
                "modified" => $user['modified'],
                "first_name" => $user['first_name'],
                "last_name" => $user['last_name'],
                "email" => $user['email'],
                "phone_number" => $user['phone_number'],
                "account_type" => $user['account_type'],
                "primary_category" => $user['primary_category'],
                "definition" => $user['definition']
            );

            header("location: dashboard.php");
            exit;
        }else{
            $error_message = "Username password didn't match.";
        }
    }
?>
<?php require "head.php";?>

<body class="bg-gradient-primary">
    <div class="bg"></div>
    <div class="container">
        
        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-sm-12 col-md-8 col-lg-5">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-12">
                                <div class="px-5 pt-4">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-600 mb-4">
                                            <b><?php echo $title;?> Login</b>
                                        </h1>
                                    </div>
                                    <?php
                                        if($error_message!=""){
                                    ?>
                                        <div class="text-center mb-2" style="color:red;">
                                            <?php echo $error_message;?>
                                        </div>
                                    <?php } ?>
                                    <form class="user" method="post">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" placeholder="username" name="user" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" placeholder="password" name="pass" required>
                                        </div>
                                        <!-- <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div> -->
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-primary btn-user btn-block" value="Login" name="log">
                                        </div>
                                        
                                        <p class="mt-4" style="margin-bottom:5px;"> Register as consumer <a href="register.php?user_definition=consumer" style="color:#f83131">here</a>.</p>
                                        <p> Register as a provider <a href="register.php?user_definition=provider" style="color:#3b5dee">here</a>.</p>
                                        <!-- <a href="index.html" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </a> -->
                                        <!--<hr>
                                        <a href="index.html" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>
                                        <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                        </a> -->
                                    </form>
                                    <!-- <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.html">Create an Account!</a>
                                    </div> -->
                                    <p class="text-center mb-0 my-3" style="color:#bbb;font-size:14px;"> Copyright &copy; <?php echo $title;?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    <?php require "auth-javascripts.php";?>
</body>

</html>