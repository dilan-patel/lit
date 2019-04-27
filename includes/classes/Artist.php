<?php

    class Artist {

        private $dbConnection;
        private $id;

        public function __construct($dbConnection, $id) {
            $this->dbConnection = $dbConnection;
            $this->id = $id;
        }

        public function getId() {
            return $this->id;
        }

        public function getTheName() {
            $getArtist = mysqli_query($this->dbConnection, "SELECT artist FROM artists WHERE id='$this->id'");
            $artist = mysqli_fetch_array($getArtist);
            return $artist['artist'];
        }

        public function getSongIds() {
            $getSong = mysqli_query($this->dbConnection, "SELECT id FROM songs WHERE artist='$this->id' ORDER BY plays DESC");
            $songArray = array();
            while($songRow = mysqli_fetch_array($getSong)) {
                array_push($songArray, $songRow['id']);
            }
            return $songArray;
        }

    }


?>