<?php

    class Account {

        private $connection;
        private $errors;

        public function __construct($connection) {
            //Constructor
            $this->connection = $connection;
            $this->errors = array();

        }

        public function register($un, $fn, $ln, $em, $cem, $pw, $cpw) {
            //Called from outside this class (register.php) so needs to be public
            $this->validateUsername($un);
            $this->validateFirstName($fn);
            $this->validateLastName($ln);
            $this->validateEmail($em, $cem);
            $this->validatePassword($pw, $cpw);

            if(empty($this->errors) == true) {
                return $this->insertData($un, $fn, $ln, $em, $pw);
            }
            else {
                return false;
            }
        }

        public function logIn($un,$pw) {
            $pw = md5($pw); // First encrypt the passwords so that it can compare with encryption stored in database.
            $logIn = mysqli_query($this->connection, "SELECT * FROM users WHERE username='$un' AND password='$pw'");
            if(mysqli_num_rows($logIn) == 1) {
                return true;
            }
            else {
                array_push($this->errors, Constants::$logInFail);
                return false;
            }
        }

        public function getError ($error) {
            //Checks to see if error passed in is in the error array.
            if(!in_array($error, $this->errors)) {
                $error = "";
            }
            return "<span class='errorMessage'>$error</span>";
        }

        private function insertData($un, $fn, $ln, $em, $pw) {
            $encryption = md5($pw); //Encrypts password in MD5 encryption method.
            $displayPicture = "assets/images/display-picture/profile.png"; //Default user profile picture.
            $date = date("Y-m-d"); //Date format
            //Insert user registration data into users table.
            $insert = mysqli_query($this->connection, "INSERT INTO users VALUES('', '$un', '$fn', '$ln', '$em', '$encryption', '$date', '$displayPicture')");
            return $insert;
        }

        //Validation Functions - Client Side
        private function validateUsername($un) {
            if(strlen($un) > 30 || strlen($un) < 5) {
                //Check to see if name is between 2-30 characters.
                array_push($this->errors, Constants::$usernameLength);
                return;
            }
            $checkUsernameExists = mysqli_query($this->connection, "SELECT username FROM users WHERE username ='$un'");
            if(mysqli_num_rows($checkUsernameExists) != 0) {
                //Check username exists
                array_push($this->errors, Constants::$usernameExists);
                return;
            }
        }

        private function validateFirstName($fn) {
            if(strlen($fn) > 30 || strlen($fn) < 2) {
                //Check to see if name is between 2-30 characters.
                array_push($this->errors, Constants::$firstNameLength);
                return;
            }
        }

        private function validateLastName($ln) {
            if(strlen($ln) > 30 || strlen($ln) < 2) {
                //Check to see if name is between 2-30 characters.
                array_push($this->errors, Constants::$lastNameLength);
                return;
            }
        }

        private function validateEmail($em, $cem) {
            if($em != $cem) {
                //Check to see if e-mail matches confirm e-mail.
                array_push($this->errors, Constants::$emailDontMatch);
                return;
            }
            if(!filter_var($em, FILTER_VALIDATE_EMAIL)) {
                //Check to see if input is a valid e-mail.
                array_push($this->errors, Constants::$emailInvalid);
                return;
            }
            $checkEmailExists = mysqli_query($this->connection, "SELECT email FROM users WHERE email ='$em'");
            if(mysqli_num_rows($checkEmailExists) != 0) {
                //Check username exists
                array_push($this->errors, Constants::$emailExists);
                return;
            }
        }

        private function validatePassword($pw, $cpw) {
            if($pw != $cpw) {
                //Check to see if password is equal to confirm password.
                array_push($this->errors, Constants::$passwordDontMatch);
                return;
            }

            if(preg_match('/[^A-Za-z0-9]/', $pw)) {
                //Check to see if password contains only letters and numbers.
                array_push($this->errors, Constants::$passwordAlphanumeric);
                return;
            }

            if(strlen($pw) > 30 || strlen($pw) < 6) {
                //Check to see if password is between 6 to 30 characters.
                array_push($this->errors, Constants::$passwordLength);
                return;
            }
        }

    }


?>