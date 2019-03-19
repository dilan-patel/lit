<?php
class Constants {

    //Error messages for registration
    public static $usernameLength = "Your username must be between 5 and 30 characters.";
    public static $usernameExists = "That username already exists. Please try another.";
    public static $firstNameLength = "Your first name must be between 2 and 30 characters.";
    public static $lastNameLength = "Your last name must be between 2 and 30 characters.";
    public static $emailDontMatch = "Your e-mails must match.";
    public static $emailInvalid = "Your e-mail must be a valid e-mail address.";
    public static $emailExists = "That e-mail has already been used. Please try another.";
    public static $passwordDontMatch = "Your passwords must match.";
    public static $passwordAlphanumeric = "Your password must only contain letters and numbers.";
    public static $passwordLength = "Your password must be between 6 and 30 characters.";

    //Error messages for log in
    public static $logInFail = "Your username or password was incorrect.";

}


?>