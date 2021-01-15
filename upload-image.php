<?php
    if(!isset($_POST["reg"])){
        header("location: index.php");
        exit;
    }
    function genRan(){return rand((int)10000000,(int)99999999);}
    $random_numbers1 = genRan();
    $random_numbers2 = genRan();
    $target_dir = "users-pictures/" . $random_numbers1 . "/";
    mkdir($target_dir, 0700);
    $path = $_FILES["fileToUpload"]["name"];
    $imageFileType = strtolower(pathinfo($path,PATHINFO_EXTENSION));
    $target_file = $target_dir . $random_numbers2 . "." . $imageFileType;
    $saveToDatabase = $random_numbers1 . "/" . $random_numbers2 . "." . $imageFileType;
    $uploadOk = 1;

    // Check if image file is a actual image or fake image
    if(isset($_POST["reg"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        rmdir($target_dir);
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }