<?php
// Include the configuration file
include ('config.php');

// If the user is not logged in, redirect them to the login page
if(!isset($_SESSION['user_name'])){
    header('location:Index.php');
}

// Check if the user has already entered an OTP (one-time password) - if so, redirect them to the OTP verification page
$select     = "SELECT * FROM user_form WHERE id = {$_SESSION['user_id']} ";
$query     = $conn->query($select);
$user = $query->fetch_assoc();
if ($user['otp'] != null) {
    header('location:otp.php');
    die();
}

?>

<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="Style.css">
    <script> src="main.js"</script>
</head>
<title></title>
<body class ="body_index">
<header>
    <div class="Container">
        <!-- Header section with a welcome message -->
        <h3>Hello <span>User</span></h3>
        <h1>Welcome <span><?php echo $_SESSION['user_name'] ?></span></span></h1>
    </div>
    <nav>
        <!-- Navigation bar with links to other pages -->
        <ul>
            <li><a href="Website_Admin.php">KeepSafe</a></li>
            <li><a href="Passwor Generator.php">Get a new Password</a></li>
            <li><a href="PasswordStrengthTester.php">Test your Password</a></li>
            <li><a href="LogOut.php">LogOut</a></li>
        </ul>
    </nav>
     <!-- Horizontal line -->
    <div class ="line1">
    </div>
     <!-- Style to make the inner divs display inline -->
    <style>
        .content div{
            display: inline-block;;
        }
    </style>
</header>
<!-- Main content section -->
<div class="content" style="padding: 30px; display: inline-block;">
    <?php
    // Query the database to get all accounts, ordered by creation date
    $accounts = mysqli_query($conn, "SELECT * FROM accounts order by created_at");
    // If there are accounts in the database, display them
    if (mysqli_num_rows($accounts) > 0){
        while ( $row = mysqli_fetch_assoc($accounts)){
            ?>
            <!-- Display the account information -->
            <div class="accounts" align="center">
                <p style="color:#fff; margin: 2px;"><?php echo $row['username']; ?></p>
                <img src="images/<?php echo $row['image']; ?> " alt="" width="145px" height="127px;"><br>
                <a href="view.php?id=<?php echo $row['id']; ?>">view</button>
            </div>
        <?php } }?>
        <!-- Add button to create a new account -->
    <div class="notched">
        <a href="add.php">
            <div class="inner">
                <svg style="width:70px;" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="#ffffff" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title></title> <g id="Complete"> <g data-name="add" id="add-2"> <g> <line fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" x1="12" x2="12" y1="19" y2="5"></line> <line fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" x1="5" x2="19" y1="12" y2="12"></line> </g> </g> </g> </g></svg>
            </div>
        </a>
    </div>
</div>
</body>
</html>
