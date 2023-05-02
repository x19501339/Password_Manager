<?php

// include the configuration file
include ('config.php');
// check if the user is logged in as an admin or regular user, and redirect them to the login page if not
if(!isset($_SESSION['admin_name']) && !isset($_SESSION['user_name'])){
    header('location:Index.php');
}

// check if the user has completed the OTP verification process, and redirect them to the OTP page if not
$select     = "SELECT * FROM user_form WHERE id = {$_SESSION['user_id']} ";
$query     = $conn->query($select);
$user = $query->fetch_assoc();
if ($user['otp'] != null) {
    header('location:otp.php');
    die();
}
// get the ID of the account to view from the URL parameter
$id = $_GET['id'];
// get the account with the specified ID from the database
$select     = "SELECT * FROM accounts WHERE id = '$id'  ";
$query     = $conn->query($select);
$user = mysqli_num_rows($query);
// if no account was found, redirect the user to the appropriate page based on their role
if ($user < 1) {
    if(isset($_SESSION['admin_name'] )){
        header('location: Website_Admin.php');
    } else {
        header('location: website.php');
    }
}
// set the "back" link based on the user's role
if(isset($_SESSION['admin_name'] )){
    $back = "Website_Admin.php";
} else {
    $back = "website.php";
}
// get the account details from the query result
$user1 = $query->fetch_assoc();



?>

<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="Style.css">

</head>
<title></title>
<body onload="runcheck()" class ="body_index">
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
    .container .strengthMeter::before{
        content: '';
        width: 0;
        height: 100%;
        transition: 0.5s;
    }
    .container.weak .strengthMeter::before{
        width: 10%;
        background: #f00;
        display: block;
        height: 3px;
        float: left;
        margin-left: 1px;
    }

    .container.medium .strengthMeter::before{
        width: 66.66%;
        background: #ffa500;
        filter: drop-shadow(0 0 5px #ffa500) drop-shadow(0 0 10px #ffa500) drop-shadow(0 0 20px #ffa500);
    }

    .container.strong .strengthMeter::before{
        width: 100%;
        background: #0f0;
        filter: drop-shadow(0 0 5px #0f0) drop-shadow(0 0 10px #0f0) drop-shadow(0 0 20px #0f0);
    }

    .container .strengthMeter::after{
        top: -45px;
        left: 30px;
        color: #fff;
        transition: 0.5s;
    }

    .container.weak .strengthMeter::after{
        content: 'Your Password is Weak';
        color: #f00;
        filter: drop-shadow(0 0 5px #f00);
    }

    .container.medium .strengthMeter::after{
        content: 'Your Password is Medium';
        color: #ffa500;
        filter: drop-shadow(0 0 5px #ffa500);
    }

    .container.strong .strengthMeter::after{
        content: 'Your Password is Strong';
        color: #0f0;
        filter: drop-shadow(0 0 5px #0f0);
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
                    <a href="delete.php?id=<?php echo $user1['id']; ?>" style="float: right;"> Delete</a>
                </div>
                <form id="form1" action="save.php" enctype="multipart/form-data" method="post">
                    <p style="color:#fff;"> View Account</p>
                    <div align="center">
                        <img id="blah" src="images/<?php echo $user1['image']; ?>" alt="your image" width="100" height="100" />
                    </div>
                    <div align="center" style="margin-top:10px; ">
                        <input type='file' value="" name="fileToUpload" id="imgInp" style="display: none;" accept="image/png, image/gif, image/jpeg" onchange="PreviewImage();"/>
<!--                        <input type="button" class="btn btn-defalt" value="CHOOSE" ONCLICK="imgInp.click()">-->
                    </div>

                    <div align="center" class="form-control">
                        <label for="url">URL <a href="#!" onclick="copy_text('url')" style="float: right;">COPY</a></label>
                        <input type="text" value="<?php echo $user1['url']; ?>" id="url" readonly placeholder="Enter URL" name="url" required>
                    </div>
                    <div align="center" class="form-control">
                        <label for="username">Username <a href="#!" onclick="copy_text('username')" style="float: right;">COPY</a></label>
                        <input type="text" id="username" value="<?php echo $user1['username']; ?>" readonly placeholder="Enter username" name="username" required>
                    </div>
                    <div align="center" class="form-control">
                        <label for="password">Password <a href="#" onclick="copy_text('password')" style="float: right;">COPY</a></label>
                        <input type="text" id="myPassword" value="<?php echo $user1['password']; ?>" readonly placeholder="Enter password" name="password" required>
                        <div class="container">
                            <div class="strengthMeter"></div>
                        </div>
                    </div>
                    <div align="center" class="form-control">
                        <a href="Passwor%20Generator.php" target="_blank">Click here to get password suggestions</a>
                    </div>
                </form>
            </div>
        </div>
</div>
</body>
<script src="mainview.js"></script>

<script type="text/javascript">
    function copy_text(element) {
        var copyTextarea = document.getElementById(element);
        copyTextarea.focus();
        copyTextarea.select();

        try {
            var successful = document.execCommand('copy');
            var msg = successful ? 'successful' : 'unsuccessful';
            alert('Text copied');
        } catch (err) {
            alert('Oops, unable to copy');
        }
    }
</script>
</html>
