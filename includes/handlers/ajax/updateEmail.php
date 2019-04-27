<?php

include("../../config.php");

if(!isset($_POST['username'])) {
    echo "Could not set username.";
    exit();
}

if(isset($_POST['email']) && $_POST['email'] != "") {
    $username = $_POST['username'];
    $email = $_POST['email'];

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "This e-mail is invalid.";
        exit();
    }

    $checkEmail = mysqli_query($dbConnection, "SELECT email FROM users WHERE email='$email' AND username != '$username'");
    if(mysqli_num_rows($checkEmail) > 0) {
        echo "This e-mail is already in use.";
        exit();
    }

    $updateEmail = mysqli_query($dbConnection, "UPDATE users SET email = '$email' WHERE username='$username'");
    echo "Successfully updated e-mail.";

}
else {
    echo "An e-mail must be provided.";
}

?>