<?php

    class Artist {

        private $connection;
        private $id;

        public function __construct($connection, $id) {
            $this->connection = $connection;
            $this->id = $id;
        }

        public function getId() {
            return $this->id;
        }

        public function getName() {
            $getArtist = mysqli_query($this->connection, "SELECT artist FROM artists WHERE id='$this->id'");
            $artist = mysqli_fetch_array($getArtist);
            return $artist['artist'];
        }

        public function getSongIds() {
            $getSong = mysqli_query($this->connection, "SELECT id FROM songs WHERE artist='$this->id' ORDER BY plays DESC");
            $songArray = array();
            while($row = mysqli_fetch_array($getSong)) {
                array_push($songArray, $row['id']);
            }
            return $songArray;
        }

    }


?>