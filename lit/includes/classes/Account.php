<?php

    class Account {

        private $errorArray;

        public function __construct() {
            //Constructor
            $this->errorArray = array();

        }

        public function register($un, $fn, $ln, $em, $cem) {
            //Called from outside this class (register.php) so needs to be public
            $this->validateUsername($un);
            $this->validateFirstName($fn);
            $this->validateLastName($ln);
            $this->validateEmail($em, $cem);
            $this->validatePassword($pw, $cpw);
        }

        //Validation Functions - Client Side
        private function validateUsername($un) {
            if(strlen($un) > 30 || strlen($un) < 5) {
                //Check to see if name is between 2-30 characters.
                array_push($this->errorArray, "Your username must be between 5 and 30 characters.");
                return;
            }
        }
        private function validateFirstName($fn) {
            if(strlen($fn) > 30 || strlen($fn) < 2) {
                //Check to see if name is between 2-30 characters.
                array_push($this->errorArray, "Your first name must be between 2 and 30 characters.");
                return;
            }
        }
        private function validateLastName($ln) {
            if(strlen($ln) > 30 || strlen($ln) < 2) {
                //Check to see if name is between 2-30 characters.
                array_push($this->errorArray, "Your last name must be between 2 and 30 characters.");
                return;
            }
        }
        private function validateEmail($em, $cem) {
            if($em != $cem) {
                //Check to see if e-mail matches confirm e-mail.
                array_push($this->errorArray, "Your e-mails must match.");
                return;
            }
            if(!filter_var($em, FILTER_VALIDATE_EMAIL)) {
                //Check to see if input is a valid e-mail.
                array_push($this->errorArray, "Your e-mail must be a valid e-mail address.");
                return;
            }
        }
        private function validatePassword($pw, $cpw) {
            if($pw != $cpw) {
                //Check to see if password is equal to confirm password.
                array_push($this->errorArray, "Your passwords must match.");
                return;
            }

            if(preg_match('/[^A-Za-z0-9]/', $pw)) {
                //Check to see if password contains only letters and numbers.
                array_push($this->errorArray, "Your password must only contain letters and numbers.");
                return;
            }

            if(strlen($pw) > 30 || strlen($pw) < 6) {
                //Check to see if password is between 6 to 30 characters.
                array_push($this->errorArray, "Your password must be between 6 and 30 characters.");
                return;
            }



        }

    }


?>