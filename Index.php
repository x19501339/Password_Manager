<?php
     // include the configuration file which contains the database connection details
    include ('config.php');

     // Check if the login form has been submitted
    if (isset($_POST['submit'])){

        // get the user's email and password from the form and prevent SQL injection attacks with mysqli_real_escape_string
        $email      = mysqli_real_escape_string($conn, $_POST['email']);
        $pass       = md5($_POST['password']);
        $errors     = [];
       
        // select the user's information from the database based on the provided email and password
        $select     = "SELECT * FROM user_form WHERE email = '$email' AND password = '$pass' ";
        $result     = mysqli_query($conn, $select);

        // check if a user was found with the provided email and password
        if(mysqli_num_rows($result) > 0)
        {
            $row = mysqli_fetch_array($result);

            // if the user is an admin, set session variables and redirect to OTP page
            if($row['user_type'] == 'admin')
            {
                $_SESSION['admin_name']     = $row['name'];
                $_SESSION['admin_id']       = $row['id'];
                $_SESSION['user_id']       = $row['id'];
                header('location:otp.php');
            }
             // if the user is a regular user, set session variables and redirect to OTP page
            elseif($row['user_type'] == 'user')
            {
                $_SESSION['user_name']      = $row['name'];
                $_SESSION['user_id']        = $row['id'];
                header('location:otp.php');
            }
            // if the user type is not recognized, add an error message to the errors array
            else
            {
                $errors[] = 'Wrong User Type. Please Select Correct User type';
            }
        }
        // if the provided email and password do not match any users in the database, add an error message to the errors array
        else
        {
            $errors[]     = 'Incorrect Email or Password Please try Again';
        }
}
?>

<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="style.css"> 
    <script> src="main.js"</script>
</head>
<title></title>
<body>
    <div class ="login-box">
        <h2>Login</h2>
        <?php
             // if there are any errors from the login attempt, display them to the user
            if(isset($errors)){
                foreach($errors as $error){
                    echo '<div class = "error">'.$error.'</div>';
                };
            };
             // if the user has just registered, display a success message to prompt them to log in
            if(isset($_GET['message']) && $_GET['message']=='success')
            {
                echo '<div class="success">Registration successful. Please Login</div>';
            }
        ?>
        <form method="post" action="#">
            <div class="user-box">
                <input type="email" name="email" required="" placeholder="Email">
                <label></label>
                <input type="password" name="password" required="" placeholder="password">
                <label></label>
                <input id="submit" name="submit" href="" type="submit" value="login">
            </div>
            <div class ="button-form">
                <div id="register">
                    Don't have an account?
                    <a href="Sign-up.php">Register</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html> 