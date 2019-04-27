<?php

//Sanitization Functions

function sanitizeUsername($inputText) {
    $inputText = strip_tags($inputText);
    //Strips html elements from string so no tags involved in input
    $inputText = str_replace(" ", "", $inputText);
    //Removes space from variable
    return $inputText;
}

function sanitizeString($inputText) {
    $inputText = strip_tags($inputText);
    //Strips html elements from string so no tags involved in input
    $inputText = str_replace(" ", "", $inputText);
    //Removes space from variable
    $inputText = ucfirst(strtolower($inputText));
    //Uppercases first character by converting string to lower first, then the first character to uppercase
    return $inputText;
}

function sanitizePassword($inputText) {
    $inputText = strip_tags($inputText);
    //Strips html elements from string so no tags involved in input
    return $inputText;
}

if(isset($_POST['rgButton'])) {
    //Sign Up button pressed

    $username = sanitizeUsername($_POST['rgUsername']);
    $firstName = sanitizeString($_POST['rgFirstName']);
    $lastName = sanitizeString($_POST['rgLastName']);
    $email = sanitizeString($_POST['rgEmail']);
    $confirmEmail = sanitizeString($_POST['rgConfirmEmail']);
    $password = sanitizePassword($_POST['rgPassword']);
    $confirmPassword = sanitizePassword($_POST['rgConfirmPassword']);

    $regSuccess = $userAccount->register($username, $firstName, $lastName, $email, $confirmEmail, $password, $confirmPassword);

    if($regSuccess == true) {
        $_SESSION['userLoggedIn'] = $username; //Sets session to username the user used to register.
        header("Location: index.php"); //Takes user to index page if registration successful.
    }

}

?>