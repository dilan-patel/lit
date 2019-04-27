<?php

    class Song {

        private $dbConnection;
        private $id;
        private $mysqliData;
        private $title;
        private $artist;
        private $album;
        private $genre;
        private $duration;
        private $path;

        public function __construct($dbConnection, $id) {
            $this->dbConnection = $dbConnection;
            $this->id = $id;

            $getSong = mysqli_query($this->dbConnection, "SELECT * FROM songs WHERE id='$this->id'");
            $this->mysqliData = mysqli_fetch_array($getSong);
            $this->title = $this->mysqliData['title'];
            $this->artist = $this->mysqliData['artist'];
            $this->album = $this->mysqliData['album'];
            $this->genre = $this->mysqliData['genre'];
            $this->duration = $this->mysqliData['duration'];
            $this->path = $this->mysqliData['path'];

        }

        public function getId() { 
            return $this->id;
        }

        public function getTitle() { 
            return $this->title;
        }
    
        public function getMusicArtist() {

            return new Artist ($this->dbConnection, $this->artist);
        }

        public function getSongAlbum() {
            return new Album ($this->dbConnection, $this->album);
        }

        public function getGenre() {
            return $this->genre;
        }
        
        public function getDuration() {
            return $this->duration;
        }
        
        public function getPath() {
            return $this->path;
        }
        

    }


?>