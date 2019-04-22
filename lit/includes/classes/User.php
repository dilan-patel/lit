<?php

    class User {

        private $connection;
        private $username;

        public function __construct($connection, $username) {
            //Constructor
            $this->connection = $connection;
            $this->username = $username;
        }

        public function getUsername(){
            return $this->username;
        }

        public function getEmail(){
            $emailQuery = mysqli_query($this->connection, "SELECT email FROM users WHERE username='$this->username'");
            $row = mysqli_fetch_array($emailQuery);
            return $row['email'];
        }

        public function getFullName(){
            $nameQuery = mysqli_query($this->connection, "SELECT concat(firstName, ' ', lastName) AS 'name' FROM users WHERE username='$this->username'");
            $row = mysqli_fetch_array($nameQuery);

            return $row['name'];
        }

    }


?>