<?php
//Include the configuration file
include ('config.php');
//Redirect if the user is not logged in
if(!isset($_SESSION['admin_name']) && !isset($_SESSION['user_name'])){
    header('location:Index.php');
}

//Check if the user needs to verify an OTP
$select     = "SELECT * FROM user_form WHERE id = {$_SESSION['user_id']} ";
$query     = $conn->query($select);
$user = $query->fetch_assoc();
if ($user['otp'] != null) {
    header('location:otp.php');
    die();
}
//Set the 'back' variable based on whether the user is an admin or not
if(isset($_SESSION['admin_name'] )){
    $back = "Website_Admin.php";
} else {
    $back = "website.php";
}

?>

<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="Style.css">
    <script> src="main.js"</script>
</head>
<title></title>
<body class ="body_index">
<style>
    .notched:after {
        content: "";
        position: absolute;
        margin: 428px 346px;
        width: 66px;
        height: 127px;
        transform: rotate(45deg);
        background-color: black;
        border: 1px solid #fff;
    }
    .notched{
        position: relative;
        width: 400px;
        height: 510px;
        background-color: #131315;
        overflow: hidden;
        margin: 0 auto;
    }
    .form-control{
        width:80%;
        margin: 10px auto;
    }
    label{
        display:block;
        text-align: left;
    }
    .form-control input{
        width:100%;
        height:30px;
    }
</style>
   <header>
   <div class="Container">
        <h3>Hello <span>User</span></h3>
        <h1>Welcome <span><?php echo $_SESSION['user_name'] ?></span></span></h1>
   </div>
        <nav>
            <ul>
                <li><a href="Website_Admin.php">KeepSafe</a></li>
                <li><a href="Passwor Generator.php">Get a new Password</a></li>
                <li><a href="PasswordStrengthTester.php">Test your Password</a></li>
                <li><a href="LogOut.php">LogOut</a></li>
            </ul>
        </nav>
<div class ="line1">
</div>
   </header>
<div class="content" style="padding: 30px">
        <div class="notched">
            <div class="inner">
                <div align="left" style="padding:0 20px">
                    <a href="<?php echo $back; ?>" class="" style="color:#fff;">Back</a>
                </div>
                <form id="form1" action="save.php" enctype="multipart/form-data" method="post">
                    <p style="color:#fff;"> Add Account</p>
                    <div align="center">
                        <img id="blah" src="add.svg" alt="your image" width="100" height="100" />
                    </div>
                    <div align="center" style="margin-top:10px; ">
                        <input type='file' name="fileToUpload" id="imgInp" style="display: none;" accept="image/png, image/gif, image/jpeg" onchange="PreviewImage();"/>
                        <input type="button" class="btn btn-defalt" value="CHOOSE" ONCLICK="imgInp.click()">
                    </div>

                    <div align="center" class="form-control">
                        <label for="url">URL</label>
                        <input type="text" placeholder="Enter URL" name="url" required>
                    </div>
                    <div align="center" class="form-control">
                        <label for="username">Username</label>
                        <input type="text" id="username" placeholder="Enter username" name="username" required>
                    </div>
                    <div align="center" class="form-control">
                        <label for="password">Password</label>
                        <input type="password" id="password" placeholder="Enter password" name="password" required>
                    </div>
                    <div align="center" class="form-control">
                        <input type="submit" name="submit" value="Save" >
                    </div>
                </form>
            </div>
        </div>
</div>
</body>
<script type="text/javascript">
//JavaScript code for previewing the selected image
    function PreviewImage() {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("imgInp").files[0]);

        oFReader.onload = function (oFREvent) {
            document.getElementById("blah").src = oFREvent.target.result;
        };
    };
</script>
</html>
