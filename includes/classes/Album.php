<?php

    class Album {

        private $dbConnection;
        private $id;
        private $title;
        private $artist;
        private $genre;
        private $artworkPath;

        public function __construct($dbConnection, $id) {
            $this->dbConnection = $dbConnection;
            $this->id = $id;

            $getAlbum = mysqli_query($this->dbConnection, "SELECT * FROM albums WHERE id='$this->id'");
            $album = mysqli_fetch_array($getAlbum);

            $this->title = $album['title'];
            $this->artist = $album['artist'];
            $this->genre = $album['genre'];
            $this->artworkPath = $album['artworkPath'];
        }

        public function getTitle() {
            return $this->title;
        }

        public function getMusicArtist() {
            return new Artist($this->dbConnection, $this->artist);
        }

        public function getGenre() {
            return $this->genre;
        }

        public function getArtworkPath() {
            return $this->artworkPath;
        }

        public function getSongTotal() {
            $songTotal = mysqli_query($this->dbConnection, "SELECT id FROM songs WHERE album='$this->id'");
            return mysqli_num_rows($songTotal);
        }

        public function getSongIds() {
            $getSong = mysqli_query($this->dbConnection, "SELECT id FROM songs WHERE album='$this->id' ORDER BY albumOrder ASC");
            $songArray = array();
            while($songRow = mysqli_fetch_array($getSong)) {
                array_push($songArray, $songRow['id']);
            }
            return $songArray;
        }

    }


?>