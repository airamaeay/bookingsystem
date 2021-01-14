<?php
    require "starter.php";
    $user_definition = "";
    if(!isset($_GET['user_definition'])){
        header("location: index.php");
        exit;
    } else {
        if($_GET['user_definition']!="consumer" && $_GET['user_definition']!="provider"){
            header("location: index.php");
            exit;
        }
        $user_definition = $_GET['user_definition'];
    }
    if(isset($_SESSION['ticket'])){
        header("location: services.php");
        exit;
    }
    $error_message="";
    if(isset($_POST['reg'])){
        $user = $_POST['user'];
        $pass = $_POST['pass'];
        $confirm_pass = $_POST['confirm_pass'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $phone_number = $_POST['phone_number'];
        if($user_definition=="provider"){
            $account_type = $_POST['account_type'];
            $category = $_POST['category'];
            $definition = "1";
        }
        if($user_definition=="consumer"){
            $account_type = "";
            $category = "";
            $definition = "2";
        }
        if($pass==$confirm_pass){
            require "upload-image.php";
            $photo = $saveToDatabase;
            $success = mysqli_query(
                $con,
                "INSERT INTO users 
                (
                    `username`,
                    `password`,
                    `picture`,
                    `created`,
                    `modified`,
                    `first_name`,
                    `last_name`,
                    `email`,
                    `phone_number`,
                    `account_type`,
                    `primary_category`,
                    `definition`
                ) VALUES (
                    '$user',
                    '$pass',
                    '$photo',
                    NOW(),
                    NOW(),
                    '$first_name',
                    '$last_name',
                    '$email',
                    '$phone_number',
                    '$account_type',
                    '$category',
                    '$definition'
                )
                "
            ); 
            if($success){
                $new_id = mysqli_insert_id($con);

                $result = mysqli_query($con,"SELECT * FROM users WHERE id='$new_id'");
                $user = mysqli_fetch_array($result,MYSQLI_ASSOC);
                    
                $_SESSION['ticket'] = array(
                    "id"=>$new_id,
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

                mysqli_query($con,"UPDATE users SET online_status = 1 WHERE id=".$_SESSION['ticket']['id']);
                
                header("location: dashboard.php");
                exit;
            }else{
                echo $con->error;
                unlink($target_file);
                rmdir($target_dir);
            }
        }else{
            $error_message = "Password confirmation didn't match.";
        }
       
    }

    $result = mysqli_query($con,"SELECT * FROM account_types");
    $account_types = mysqli_fetch_all($result,MYSQLI_ASSOC);

    $result = mysqli_query($con,"SELECT * FROM categories");
    $categories = mysqli_fetch_all($result,MYSQLI_ASSOC);

?>
<?php require "head.php";?>
<body class="bg-gradient-primary">
    <div class="bg"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Create a
                                    <?php
                                        if($user_definition=="consumer"){
                                            echo "Consumer";
                                        }
                                        if($user_definition=="provider"){
                                            echo "Provider";
                                        }
                                    ?>
                                     Account!
                                    </h1>
                                </div>
                                <form class="user" method="post" enctype="multipart/form-data">
                                    <?php
                                        if($error_message!=""){
                                    ?>
                                        <div class="text-center mb-2" style="color:red;">
                                            <?php echo $error_message;?>
                                        </div>
                                    <?php } ?>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input required name="first_name" type="text" class="form-control form-control-user" placeholder="First Name">
                                        </div>
                                        <div class="col-sm-6">
                                            <input required name="last_name" type="text" class="form-control form-control-user" placeholder="Last Name">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input required name="email" type="email" class="form-control form-control-user" placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <input required name="phone_number" type="text" class="form-control form-control-user" placeholder="Phone Number">
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-file">
                                            <input type="file" name="fileToUpload" class="custom-file-input" id="customFile">
                                            <label class="file-label custom-file-label" for="customFile">
                                                Upload Profile Picture
                                            </label>
                                        </div>
                                        <span class="hint">Maximum file size is 500kb</span>
                                    </div>
                                    <div class="form-group">
                                        <input required name="user" type="text" class="form-control form-control-user" placeholder="username">
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input required name="pass" type="password" class="form-control form-control-user" placeholder="Password">
                                        </div>
                                        <div class="col-sm-6">
                                            <input required name="confirm_pass" type="password" class="form-control form-control-user" placeholder="Repeat Password">
                                        </div>
                                    </div>
                                    
                                    <?php
                                        if($user_definition=="provider"){
                                    ?>
                                            <div style="margin-top:25px;margin-bottom:15px;">
                                                Select an Account Type
                                            </div>
                                            <div class="form-group row" style="margin-bottom:17px;">
                                                <?php
                                                    foreach($account_types as $each){
                                                ?>
                                                        <div style="margin-left:20px;margin-top:1px;margin-right:10px">
                                                            <input class="js-acc-radio" required type="radio" id="acc-<?php echo $each['id'];?>" name="account_type" value="<?php echo $each['id'];?>">
                                                        </div>
                                                        <div id="click-<?php echo $each['id'];?>" style="margin-right:20px;cursor:pointer">
                                                            <?php echo $each['account_type'];?>
                                                        </div>
                                                        <script>
                                                            $("#click-<?php echo $each['id'];?>").click(function(){
                                                                $(".js-acc-radio").removeAttr("checked");
                                                                $("#acc-<?php echo $each['id'];?>").attr("checked","checked");
                                                            });
                                                        </script>
                                                <?php
                                                    }
                                                ?>
                                            </div>
                                            <div class="form-group row" style="margin-bottom:30px;">
                                                <select name="category" class="form-control custom-select register-select">
                                                    <option selected>Select your primary category</option>
                                                    <?php
                                                        foreach($categories as $each){
                                                    ?>
                                                            <option value="<?php echo $each['id'];?>"><?php echo $each['category'];?></option>
                                                    <?php
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                    <?php
                                        }
                                    ?>
                                    <div class="form-group">
                                        <input name="reg" type="submit" class="btn btn-primary btn-user btn-block" value="Register">
                                    </div>

                                    <p class="mt-4"> If you already have an account, login <a href="login.php">here</a>.</p>
                                    <!-- <hr>
                                    <a href="index.html" class="btn btn-google btn-user btn-block">
                                        <i class="fab fa-google fa-fw"></i> Register with Google
                                    </a>
                                    <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                        <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                                    </a> -->
                                </form>
                                <!-- <hr>
                                <div class="text-center">
                                    <a class="small" href="forgot-password.html">Forgot Password?</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="login.html">Already have an account? Login!</a>
                                </div> -->
                                <p class="text-center mb-0 my-3" style="color:#bbb;font-size:14px;"> Copyright &copy; <?php echo $title;?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <?php require "auth-javascripts.php";?>
    <script>
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
</body>

</html>