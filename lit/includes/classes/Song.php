<?php

    class Song {

        private $connection;
        private $id;
        private $mysqliData;
        private $title;
        private $artist;
        private $album;
        private $genre;
        private $duration;
        private $path;

        public function __construct($connection, $id) {
            $this->connection = $connection;
            $this->id = $id;

            $getSong = mysqli_query($this->connection, "SELECT * FROM songs WHERE id='$this->id'");
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
    
        public function getArtist() {

            return new Artist ($this->connection, $this->artist);
        }

        public function getAlbum() {
            return new Album ($this->connection, $this->album);
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