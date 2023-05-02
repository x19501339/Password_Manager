<?php
// Include configuration file
include('config.php');
// Check if user is logged in
if(!isset($_SESSION['admin_name']) && !isset($_SESSION['user_name'])){
    // If not logged in, redirect to login page
    header('location.index.php');
}
// Set target directory for uploaded images
$target_dir = "images/";
// Get file name of uploaded file
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
// Set upload status to OK (1)
$uploadOk = 1;
// Get file extension of uploaded file
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    // Get information about uploaded file
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    // Check if file is actually an image
    if($check !== false) {
         // Get username, URL, password, and file information from form
        $username = $_POST['username'];
        $url = $_POST['url'];
        $password = $_POST['password'];
        $name = $_FILES["fileToUpload"]["tmp_name"];
        $real_name = $_FILES["fileToUpload"]["name"];
        // Check if user is already in the database
        $check = mysqli_query($conn, "SELECT id from accounts where username = '$username' and url = '$url' LIMIT 1") or die(mysqli_error($conn));
        $count = mysqli_num_rows($check);
        // If user already exists, display error message and exit script
        if($count > 0){
            echo "User already exist <a href='add.php'>click here</a> and try again.";
            exit;
        } else {
            // insert this user into database
            $insert = mysqli_query($conn, "INSERT INTO accounts (url, username, password, image,  created_at) 
                                                VALUES (
                                                '$url',
                                                '$username',
                                                '$password',
                                                '$real_name',
                                                now()
                                                )
                                                ") or die(mysqli_error($conn));
             // If user is successfully inserted into database, move uploaded file to target directory
            if ($insert){

                move_uploaded_file($name, $target_file);
                $uploadOk = 1;
                 // Redirect user to appropriate page based on login status
                if(isset($_SESSION['admin_name'] )){
                header('location: Website_Admin.php');
                } else {
                    header('location: website.php');
                }
            }
        }
        //first insert into database

    } else {
         // If file is not an image, display error message and set upload status to not OK (0)
        echo "File is not an image <a href='add.php'>click here</a> and try again.";
        $uploadOk = 0;
    }
}
?>
