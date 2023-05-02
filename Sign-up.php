<?php
// include database connection settings from "config.php"
include ('config.php');
// check if the form has been submitted
if (isset($_POST['submit'])){

     // Escape any special characters in the input fields and store in variables
    $name       = mysqli_real_escape_string($conn, $_POST['username']);
    $email      = mysqli_real_escape_string($conn, $_POST['email']);
    $pass       = mysqli_real_escape_string($conn, $_POST['password']);
    $cpass      = mysqli_real_escape_string($conn, $_POST['password2']);
    $user_type  = ($_POST['user_type']);
    $errors     = []; // create an empty array to store any errors
    $data       = []; // create an empty array to store any data

    // check if the user already exists in the database by executing a SELECT query
    $select     = "SELECT * FROM user_form WHERE email = '$email'";
    $result     = mysqli_query($conn, $select);

     // if the query returns any results, add an error message to the $errors array
    if(mysqli_num_rows($result) > 0)
    {

        $errors['email'] = 'user already exist';

    }
    else
    {
        // check if the passwords match
        if($pass != $cpass)
        {
            $errors['passwords'] = 'Password does not match';
        }
        else
        {
             // if there are no errors, insert the user details into the database
            if (!empty($errors)) 
            {
                  // if there are errors, set the success status to false and add the errors to the data array
                $data['success'] = false;
                $data['errors'] = $errors;
            }
            else
            {
                // hash the password using md5() function and insert user details into the database
                $pass = md5($_POST['password']);
                $insert = "INSERT INTO user_form(name, email, password, user_type) VALUES ('$name', '$email','$pass', '$user_type')";
                if(mysqli_query($conn, $insert))
                {
                    // if the query is successful, set the success status to true and redirect to the index page with a success message
                    $data['success'] = true;
                    header('location:index.php?message=success');  
                }    
            }
            
        }
    }
};

?>

<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="style.css">
    <script> src="main.js"</script>
</head>
<title>Login & Registration Form</title>
<body>
    <div class ="login-box">
        <h2>SignUp</h2>
        <?php
        if(isset($errors)){
            foreach($errors as $error){
                echo '<div class="error">'.$error.'</div>';
            };
        };
        ?>
        <form method="post" action="#">
            <div class="user-box">
                <input type="text" name="username" required="" placeholder="username">
                <label></label> 
                <input type="email" name="email" required="" placeholder="email">
                <label></label>
                <input type="password" name="password" required="" placeholder="password">
                <label></label>
                <input type="password" name="password2" required="" placeholder="confirm password">
                <label></label>
                <select name="user_type">
                    <option value="user">user</option>
                    <option value="admin">admin</option>
                </select>
                <input id="submit" href="" type="submit" name="submit" value="register">
            </div>
            <div class ="button-form">
                <div id="register">
                    Already have an account?
                    <a href="Index.php">Login</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>