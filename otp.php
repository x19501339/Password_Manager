<?php
// Include the configuration file that contains database connection details
include('config.php');

// Select user record from the database based on the ID stored in the session
$select     = "SELECT * FROM user_form WHERE id = {$_SESSION['user_id']} ";
$query     = $conn->query($select);
$user = $query->fetch_assoc();
// Check if the OTP field is empty or if the "resend" parameter is set
if ($user['otp'] == null or isset($_POST['resend'])) {
     // Generate a random 4-digit OTP
    $otp = rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9);

    // Update the user's record in the database with the OTP
    $select     = "UPDATE  user_form SET otp = {$otp} WHERE id = {$user['id']} ";
    $query     = $conn->query($select);

    // Prepare email content
    $to = $user['email'];
    $subject = "OTP CODE";
    $body = "Hi " . ucfirst($user['name']) . ", <br><br>";
    $body .= "Your 4 digit OTP Code is: " . $otp . '<br><br>';
    $body .= "If you have not requested OTP then ignore this message.";

    // Send the email to the user's email address
    $headers = "From:noreply@website.com  \r\n";
    $headers .= "X-Mailer: PHP5\n";
    $headers .= 'MIME-Version: 1.0' . "\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
     // The mail() function returns a boolean indicating whether the email was sent successfully or not
    var_export(mail($to, $subject, $body, $headers) );

     // If the OTP was sent successfully, add a success message to the message array
    $message[]     = 'OTP Code has been sent to your email address.';
}

// If the user submits the OTP form
if (isset($_POST['submit'])) {
     // Get the OTP entered by the user and sanitize it for use in SQL queries
    $otp      = mysqli_real_escape_string($conn, $_POST['otp']);
    $errors     = [];

    // If the OTP entered by the user matches the OTP stored in the database for that user
    if ($otp == (int) $user['otp']) {
         // Reset the OTP in the user's record to NULL
        $select     = "UPDATE  user_form SET otp = NULL WHERE id = {$user['id']} ";
        $query     = $conn->query($select) or die(mysqli_error($conn));

        // Redirect the user to the appropriate page based on their user type
        if ($user['user_type'] == 'admin') {
            header('location:Website_Admin.php');
        } elseif ($user['user_type'] == 'user') {
            header('location:website.php');
        }
    } {
        // If the OTP entered by the user does not match the OTP stored in the database, add an error message to the errors array
        $errors[]     = 'Incorrect OTP Code';
    }
}
?>

<!DOCTYPE html>

<head>
    <link rel="stylesheet" href="style.css">
    <script>
        src = "main.js"
    </script>
</head>
<title></title>

<body>
    <div class="login-box">
        <h2>Email OTP verification</h2>
        <?php
        if (isset($errors)) {
            foreach ($errors as $error) {
                echo '<div class = "error">' . $error . '</div>';
            };
        };
        if (isset($message)) {
            foreach ($message as $error) {
                echo '<div class = "success">' . $error . '</div>';
            };
        };
        ?>
        <form method="post" action="#">
            <div class="user-box">
                <input type="text" name="otp" required="" placeholder="4 digit pin code">
                <input id="submit" name="submit" type="submit" value="login">
            </div>
        </form>
        <div class="button-form">
            <div id="register">
                <form action="otp.php" method="post">
                    <input type="hidden" name="resend" value="true">
                    <button class="button" type="submit">Resend</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
