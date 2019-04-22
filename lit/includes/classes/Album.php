<?php

    class Album {

        private $connection;
        private $id;
        private $title;
        private $artist;
        private $genre;
        private $artworkPath;

        public function __construct($connection, $id) {
            $this->connection = $connection;
            $this->id = $id;

            $getAlbum = mysqli_query($this->connection, "SELECT * FROM albums WHERE id='$this->id'");
            $album = mysqli_fetch_array($getAlbum);

            $this->title = $album['title'];
            $this->artist = $album['artist'];
            $this->genre = $album['genre'];
            $this->artworkPath = $album['artworkPath'];
        }

        public function getTitle() {
            return $this->title;
        }

        public function getArtist() {
            return new Artist($this->connection, $this->artist);
        }

        public function getGenre() {
            return $this->genre;
        }

        public function getArtworkPath() {
            return $this->artworkPath;
        }

        public function getSongTotal() {
            $songTotal = mysqli_query($this->connection, "SELECT id FROM songs WHERE album='$this->id'");
            return mysqli_num_rows($songTotal);
        }

        public function getSongIds() {
            $getSong = mysqli_query($this->connection, "SELECT id FROM songs WHERE album='$this->id' ORDER BY albumOrder ASC");
            $songArray = array();
            while($row = mysqli_fetch_array($getSong)) {
                array_push($songArray, $row['id']);
            }
            return $songArray;
        }

    }


?>