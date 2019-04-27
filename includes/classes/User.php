<?php

    class User {

        private $dbConnection;
        private $username;

        public function __construct($dbConnection, $username) {
            //Constructor
            $this->dbConnection = $dbConnection;
            $this->username = $username;
        }

        public function getAccountUsername(){
            return $this->username;
        }

        public function getEmail(){
            $emailQuery = mysqli_query($this->dbConnection, "SELECT email FROM users WHERE username='$this->username'");
            $songRow = mysqli_fetch_array($emailQuery);
            return $songRow['email'];
        }

        public function getFullName(){
            $nameQuery = mysqli_query($this->dbConnection, "SELECT concat(firstName, ' ', lastName) AS 'name' FROM users WHERE username='$this->username'");
            $songRow = mysqli_fetch_array($nameQuery);

            return $songRow['name'];
        }

    }


?>